<?php
App::uses('Badge', 'Badge.Model');

class BadgeTest extends CakeTestCase {

	public $fixtures = array(
		'plugin.badge.badge',
		'plugin.badge.badges_unlock'
	);

	public function setUp() {
		parent::setUp();
		$this->Badge = ClassRegistry::init('Badge.Badge');
	}

	public function tearDown() {
		unset($this->Badge);

		parent::tearDown();
	}

	public function testUnlock() {
		$this->Badge->unlock(1, 1);
		$count = $this->Badge->BadgeUnlock->find('count');
		$this->assertEquals(1, $count);
		$this->Badge->unlock(1, 2);
		$count = $this->Badge->BadgeUnlock->find('count');
		$this->assertEquals(2, $count);
		$this->Badge->id = 1;
		$this->assertEquals(2, $this->Badge->field('unlock_count'));
	}

	public function testUnlockMetric() {
		$this->Badge->unlockMetric('Comment', 20, 1);
		$count = $this->Badge->BadgeUnlock->find('count');
		$this->assertEquals(2, $count);
	}

	public function testUnlockMetricMultiple() {
		$this->Badge->unlockMetric('Comment', 20, 2);
		$count = $this->Badge->BadgeUnlock->find('count');
		$this->assertEquals(3, $count);
	}

}
