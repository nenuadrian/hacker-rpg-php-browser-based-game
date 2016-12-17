<?php

namespace Model;

class Knowledge extends \Model {
    public static function knowledge() {
        return array(
            1 => array(
                    'name' => 'Reconnaissance',
                    'description' => '',
                    'skills' => function($level) {
                        return array(
                                1 => $level * 2
                            );
                    },
                    'requires' => function($level) {
                        return array(
                                'level' => $level * 1,
                                'knows' => array(
                                        2 => $level
                                    ),
                                'money' => $level * 3
                            );
                    },
                ),
                2 => array(
                        'name' => 'Cryptology',
                        'description' => '',
                        'skills' => function($level) {
                            return array(
                                    3 => $level * 2,
                                    6 => $level * 1
                                );
                        },
                        'requires' => function($level) {
                            return array(
                                    'level' => $level * 1,
                                    'knows' => array(
                                    //        2 => $level
                                        )
                                );
                        },
                    ),
                3 => array(
                            'name' => 'Stealth',
                            'description' => '',
                            'skills' => function($level) {
                                return array(
                                        5 => $level * 2
                                    );
                            },
                            'requires' => function($level) {
                                return array(
                                        'level' => $level * 1,
                                        'knows' => array(
                                        //        2 => $level
                                            )
                                    );
                            },
                        )
        );
    }

    public static function process($knowledge_string) {
        if ($knowledge_string) {
        	$user_knows = json_decode($knowledge_string, true);
        } else $user_knows = array();

        $knowledge = Knowledge::knowledge();
        foreach($knowledge as $k_id => $k) {
        	if (!isset($user_knows[$k_id])) $user_knows[$k_id] = array('level' => 0);
        }
        foreach($knowledge as $k_id => $k) {
            $user_knows[$k_id]['skills'] = $k['skills']($user_knows[$k_id]['level'] + 1);
            $user_knows[$k_id]['requires'] = $k['requires']($user_knows[$k_id]['level'] + 1);
            $fulfilled = $user_knows[$k_id]['requires']['level'] <= \Auth::get('level');
            if (isset($user_knows[$k_id]['requires']['money'])) $fulfilled = $user_knows[$k_id]['requires']['money'] <= \Auth::get('money');
            foreach ($user_knows[$k_id]['requires']['knows'] as $r_k_id => &$r_k) {
                $r_k = array('level' => $r_k, 'fulfilled' => $user_knows[$r_k_id]['level'] >= $r_k);
                $fulfilled = !$r_k['fulfilled'] ? false : $fulfilled;
            }
            $user_knows[$k_id]['requires']['fulfilled'] = $fulfilled;
        }
        return $user_knows;
    }

    public static function save($user_id, $knows) {
        $knowsData = array();
        foreach($knows as $k_id => $k) $knowsData[$k_id] = array('level' => $k['level']);
        $knowsData = json_encode($knowsData);
        \DB::update('users')->set(array('knowledge' => $knowsData))->where('id', $user_id)->execute();
    }

}
