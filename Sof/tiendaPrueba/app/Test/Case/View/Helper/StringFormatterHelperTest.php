<?php

App::uses('View', 'View');
App::uses('StringFormatterHelper', 'View/Helper');

/**
 * ProductsController Test Case
 *
 */
class StringFormatterHelperTest extends CakeTestCase {

	public $helper = null;

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		/*'app.product',
		'app.category',
		'app.rating'*/
	);

	public function setUp() {
        parent::setUp();
        $view = new View();
        $this->helper = new StringFormatterHelper($view);
    }

/**
 * testView method
 *
 * @return void
 */
	public function testFormatCurrency() {
		$this->markTestIncomplete('testFormatProducts not implemented.');
	}

}