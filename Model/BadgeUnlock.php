<?php
class BadgeUnlock extends AppModel{

    public $recursive = -1;
    public $useTable = 'badges_unlocks';
    public $belongsTo = array(
        'Badge' => array(
            'className' => 'Badge.Badge',
            'counterCache' => 'unlock_count'
        ),
        'User'
    );
    public $actsAs = array('Containable');

}