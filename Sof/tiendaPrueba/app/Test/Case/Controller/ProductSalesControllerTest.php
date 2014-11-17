<?php
App::uses('ProductSalesController', 'Controller');

/**
 * ProductSalesController Test Case
 *
 */
class ProductSalesControllerTest extends ControllerTestCase {

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
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
        $result = $this->testAction('/productSales/index');
        $this->assertInternalType('array', $this->vars['productSales']);
        debug($result);
	}


    public function testPay() {

        $ProductSales = $this->generate('ProductSales', array(
            'components' => array(
                'Session'
            )
        ));
        $Products = $this->generate('Products', array(
            'components' => array(
                'Session'
            )
        ));

        $product = $Products->Product->find('first', array('conditions'=>array('Product.id'=>1)));
        $ProductSales->ProductSale->query("INSERT INTO product_sales (sale_id,product_id,quantity, price,discount) VALUES(2,".$product['Product']['id'].",1,".$product['Product']['price'].",0);");

        $productsFact = $ProductSales->ProductSale->find('all', array('conditions'=>array('ProductSale.sale_id'=>2)));
        if ($productsFact != null) {
            $expected = true;
        } else {
            $expected = false;
        }
        //primera prueba, find wishes
        $this->assertEquals(true, $expected);


    }


    public function testGetProdsFacts(){
        $ProductSales = $this->generate('ProductSales', array(
            'components' => array(
                'Session'
            )
        ));

        $allProdBySales = $ProductSales->ProductSale->find('all', array('conditions'=>array('ProductSale.id'=>1)));
        if ($allProdBySales != null) {
            $expected = true;
        } else {
            $expected = false;
        }
        //primera prueba, find wishes
        $this->assertEquals(true, $expected);

    }



}
