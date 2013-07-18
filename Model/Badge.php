<?php
class Badge extends AppModel{

    public $recursive = -1;
    public $actsAs = array('Containable');
    public $hasMany =array(
        'BadgeUnlock' => array(
            'className' => 'Badge.BadgeUnlock',
            'dependent' => true
        )
    );

    /**
     * Unlock a badge
     * @param  int $badge_id
     * @param  int $user_id
     * @return boolean           true if badge is unlocked, false if the user already got this badge
     */
    public function unlock($badge_id, $user_id){
        $count = $this->BadgeUnlock->find('count', array(
            'conditions' => array('user_id' => $user_id, 'badge_id' => $badge_id)
        ));
        if($count){
            return false;
        }
        $this->BadgeUnlock->create(array(
            'user_id' => $user_id,
            'badge_id'=> $badge_id
        ), true);
        return $this->BadgeUnlock->save();
    }

    public function unlockMetric($metric, $count, $user_id){
        $unlocked = $this->BadgeUnlock->find('list', array(
            'fields' => array('badge_id', 'badge_id'),
            'conditions' => array(
                'Badge.metric' => $metric,
                'user_id'=> $user_id
            ),
            'contain' => array('Badge')
        ));
        $available = $this->find('list', array(
            'fields'     => array('Badge.id', 'Badge.id'),
            'conditions' => array('metric' => $metric, 'metric_count <=' => $count)
        ));
        $unlocks = array_diff($available, $unlocked);
        foreach($unlocks as $badge_id){
            $this->BadgeUnlock->create();
            $this->BadgeUnlock->save(array(
                'badge_id' => $badge_id,
                'user_id'  => $user_id
            ));
        }
        return true;
    }

}