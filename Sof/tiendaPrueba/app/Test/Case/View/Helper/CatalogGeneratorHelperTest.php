<?php

App::uses('View', 'View');
App::uses('CatalogGeneratorHelper', 'View/Helper');

/**
 * ProductsController Test Case
 *
 */
class CatalogGeneratorHelperTest extends CakeTestCase {

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
        $this->helper = new CatalogGeneratorHelper($view);
    }

/**
 * testView method
 *
 * @return void
 */
	public function testFormatProducts() {
		$this->markTestIncomplete('testFormatProducts not implemented.');
	}

	public function testDisplayRatingBox() {
		$this->markTestIncomplete('testDisplayRatingBox not implemented.');
	}

}