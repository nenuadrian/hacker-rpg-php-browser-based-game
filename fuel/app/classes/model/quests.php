<?php
use \Model\Task;
namespace Model;

class Quests extends \Model {


    public static function groups() {
        $groups = \DB::select('quest_group.*')->from('quest_group')->where('type', 1)->where('live', 1)->where('level', '<=', \Auth::get('level'))->
            join('user_mission', 'LEFT OUTER')->on('user_mission.quest_id', '=', 'required_quest_id')->and_on('user_mission.user_id', '=', \DB::expr(\Auth::get('id')))->where(function($q){ 
                return $q->where('required_quest_id', 0)->or_where('user_mission_id', 'IS NOT', NULL);
            });

        $groups = $groups->order_by('group_order', 'asc')->execute()->as_array();

        return $groups;
    }

    public static function missions($group = false, $limit = false) {
        $quests = \DB::select('quest.*', 'um2.last_done')->from('quest');
        if ($group) $quests = $quests->where('quest_group_id', $group);

        $quests = $quests->where('live', 1)->where('level', '<=', \Auth::get('level'))
        ->join(array('user_mission', 'um2'), 'LEFT OUTER')->on('um2.quest_id', '=', 'quest.quest_id')->and_on('um2.user_id', '=', \DB::expr(\Auth::get('id')))
        ->join(array('user_mission', 'um'), 'LEFT OUTER')->on('um.quest_id', '=', 'required_quest_id')->and_on('um.user_id', '=', \DB::expr(\Auth::get('id')))->where(function($q){ 
            return $q->where('required_quest_id', 0)->or_where('um.user_mission_id', 'IS NOT', NULL);
        });

        if ($limit) $quests->limit($limit);

        return $quests->execute()->as_array();
    }

    public static function of($group) {
        
        $quests = Quests::missions($group);

        return $quests;
    }

    public static function record_completion($user_id, $quest_id, $time) {
        $user_mission = \DB::select('user_mission_id', 'best_time')->from('user_mission')->where('quest_id', $quest_id)->where('user_id', $user_id)->execute()->as_array();
        if (!count($user_mission)) {
            \DB::insert('user_mission')->set(array('quest_id' => $quest_id, 'user_id' => $user_id, 'last_done' => time(), 'best_time' => $time))->execute();
        } else {
            \DB::update('user_mission')->set(array('times' => \DB::expr('times + 1'), 'last_done' => time(), 'best_time' => min($time, $user_mission[0]['best_time'])))->where('user_mission_id', $user_mission[0]['user_mission_id'])->execute();
        }
    }
 
}