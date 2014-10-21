<?php
App::uses('Wish', 'Model');

/**
 * Wish Test Case
 *
 */
class WishTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.wish',
		'app.user',
		'app.product',
		'app.category',
		'app.rating'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Wish = ClassRegistry::init('Wish');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Wish);

		parent::tearDown();
	}

}
