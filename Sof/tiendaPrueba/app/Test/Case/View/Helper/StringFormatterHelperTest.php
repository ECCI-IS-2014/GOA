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

		$this->assertEquals('$100.00', $this->helper->formatCurrency(100, '$'));
		$this->assertEquals('$50.89', $this->helper->formatCurrency(50.8901023, '$'));
		$this->assertEquals('$32,800.00', $this->helper->formatCurrency(32800, '$'));
		$this->assertEquals('$9,289,200.90', $this->helper->formatCurrency(9289200.9012, '$'));

	}

}