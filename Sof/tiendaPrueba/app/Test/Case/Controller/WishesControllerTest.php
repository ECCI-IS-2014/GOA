<?php
App::uses('WishesController', 'Controller');

/**
 * WishesController Test Case
 *
 */
class WishesControllerTest extends ControllerTestCase {

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
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
        $result = $this->testAction('/wishes/index');
        $results = $this->headers['Location'];
        $expected = 'http://localhost/GOA/Sof/tiendaPrueba/wishes/index';
        // check redirect
        $this->assertEquals($results, $expected);
        debug($result);
	}


/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
        /*$result = $this->testAction('/wishes/add');
        debug($result);*/
	}


/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
        /*$result = $this->testAction('/wishes/delete');
        debug($result);*/
	}

}
