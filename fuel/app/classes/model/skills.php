<?php

namespace Model;

class Skills extends \Model {
    public static function skills() {
        return array(
            1 => array(
                    'name' => 'Parallel programming',
                    'description' => 'Computers generally execute code sequentially. For example, summing 1, 2, 3 and 4 means doing it in steps ((1 + 2) + 3) + 4, but with parallel programming one can run 1 + 2 on a computer and 3 + 4 on another and subsequentally sum up the two results, obtaining quicker computation times.',
                    'influence' => function($level) {
                            return array(
                                'crack_1' => $level * 2
                                );
                        }
                ),
            2 => array(
                'name' => 'Vulnerability analysis',
                'description' => 'A vital skill for any hacker. As this skill improves, you will get a natural feel for where vulnerabilities should be and when exploits could be most effectivelly used.',
                'influence' => function($level) {
                            return array(
                                'crack_1' => $level * 2
                                );
                        }
                ),
            3 => array(
                'name' => 'Network security',
                'description' => 'Every device produced today is automatically joined to one network or another. Network security administrators have become a necessity even for the corner shops. The best way to know how to protect something is to learn how to break into it.',
                'influence' => function($level) {
                            return array(
                                'crack_1' => $level * 2,
                                'scan' => $level * 2
                                );
                        }
                ),
            4 => array(
                'name' => 'Database',
                'description' => '',
                'influence' => function($level) {
                            return array(
                                'crack_3' => $level * 2,
                                );
                        }
                ),
            5 => array(
                'name' => 'Firewall cracking',
                'description' => '',
                'influence' => function($level) {
                            return array(
                                'crack_1' => $level * 2,
                                'crack_2' => $level * 2,
                                'crack_3' => $level * 2,
                                );
                        }
                ),
            6 => array(
                'name' => 'Cryptography',
                'description' => '',
                'influence' => function($level) {
                            return array(
                                'decrypt' => $level * 2,
                                );
                        }
            )
        );
    }

    public static function influence_total($skills_string) {
        $skills = Skills::process($skills_string);
        $skills_influence = array();
        foreach($skills as $s)
            foreach($s['influence'] as $in => $v)
                $skills_influence[$in] = isset($skills_influence[$in]) ? $skills_influence[$in] + $v : $v;
        return $skills_influence;
    }
    public static function process($skills_string)
    {
        if ($skills_string) {
        	$user_skills = json_decode($skills_string, true);
        } else $user_skills = array();

        $skills = Skills::skills();
        foreach(array_keys($skills) as $i) {
        	if (!isset($user_skills[$i])) {
        		$user_skills[$i] = array( 'level' => 1, 'exp' => 0);
        	}
        	$user_skills[$i]['exp_next'] = Skills::experience($user_skills[$i]['level'] + 1);
            $user_skills[$i]['influence'] = $skills[$i]['influence']($user_skills[$i]['level']);
            $user_skills[$i]['influence_next'] = $skills[$i]['influence']($user_skills[$i]['level'] + 1);
        }
        return $user_skills;
    }

    public static function experience($level) {
    	return $level * 10;
    }

    public static function add_experience(&$skill, $exp) {
    	if (!isset($skill['exp_next'])) $skill['exp_next'] = Skills::experience($skill['level'] + 1);

    	$skill['exp'] += $exp;
    	while($skill['exp'] >= $skill['exp_next']) {
    		$skill['level'] += 1;
    		$skill['exp'] -= $skill['exp_next'];
    		$skill['exp_next'] = Skills::experience($skill['level'] + 1);
    	}
    }

    public static function save($user_id, $skills) {
        $updateSkills = array();
        foreach($skills as $id => $s) {
            $updateSkills[$id] = array('level' => $s['level'], 'exp' => $s['exp']);
        }
        \DB::update('users')->set(array('skills' => json_encode($updateSkills)))->where('id', $user_id)->execute();
    }
}
