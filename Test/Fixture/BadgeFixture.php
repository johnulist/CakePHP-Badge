<?php
/**
 * BadgeFixture
 *
 */
class BadgeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'metric' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'metric_count' => array('type' => 'integer', 'null' => true, 'default' => '0'),
		'unlock_count' => array('type' => 'integer', 'null' => true, 'default' => '0'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'name' => 'Blabla',
			'description' => 'One comment posted',
			'metric' => 'Comment',
			'metric_count' => 1,
			'unlock_count' => 0,
			'created' => '2013-07-17 14:09:32'
		),
		array(
			'id' => 2,
			'name' => 'Blabla',
			'description' => '10 comments posted',
			'metric' => 'Comment',
			'metric_count' => 10,
			'unlock_count' => 0,
			'created' => '2013-07-17 14:09:32'
		)
	);

}
