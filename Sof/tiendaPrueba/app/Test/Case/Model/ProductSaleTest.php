<?php
App::uses('ProductSale', 'Model');

/**
 * ProductSale Test Case
 *
 */
class ProductSaleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.product_sale',
		'app.sale',
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
		$this->ProductSale = ClassRegistry::init('ProductSale');
	}

/**
 * tearDown method
 *
 * @return void
 */

    public function testGetAll() {
        $p_sales = $this->ProductSale->getAllProductSales();
        // en fixtures se tienen 1 product sale definida
        $this->assertCount( 1, $p_sales );
    }


	public function tearDown() {
		unset($this->ProductSale);

		parent::tearDown();
	}

}
