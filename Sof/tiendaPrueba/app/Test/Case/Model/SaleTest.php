<?php
App::uses('Sale', 'Model');

/**
 * Sale Test Case
 *
 */
class SaleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sale',
        'app.product_sale',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Sale = ClassRegistry::init('Sale');
	}



    public function testGetAll() {
        $p_sales = $this->Sale->getAllSales();
        // en fixtures se tienen 1 product sale definida
        $this->assertCount( 2, $p_sales );
    }






/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sale);

		parent::tearDown();
	}

}
