<?php
App::uses('SalesController', 'Controller');

/**
 * SalesController Test Case
 *
 */
class SalesControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sale',
		'app.user'
	);


	public function testCheckout() {
/*
        $Sales = $this->generate('Sales', array(
            'components' => array(
                'Session'
            )
        ));
        $Products = $this->generate('Products', array(
            'components' => array(
                'Session'
            )
        ));


        // reiniciando parametros

        $this->Session->write('saleCart');
        $saleCart = array(0);
        $this->Session->write('saleCart',$saleCart);

        $this->Session->write('numProducts');
        $numProducts = array(0);
        $this->Session->write('numProducts',$numProducts);

        $this->Session->write('totalCartProducts');
        $totalCartProducts = 0;
        $this->Session->write('totalCartProducts',$totalCartProducts);

        $this->Session->write('flag',1);  // que lo lea directamente de la session de sale y no del carrito

        // simulando escenario
        array_push($saleCart,1);
        array_push($numProducts,1);
        $totalCartProducts =  1;
        $this->Session->write('cart',$saleCart);
        $this->Session->write('numProducts',$numProducts);
        $this->Session->write('totalCartProducts',$totalCartProducts);
        $this->Session->write('frequent_client',false);
        $Sales->Session->write('flag',1);
 */
        // llamando metodo de checkout */
        $this->markTestIncomplete('testEdit not implemented.');
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
		$this->markTestIncomplete('testEdit not implemented.');
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
		$this->markTestIncomplete('testDelete not implemented.');
	}

}
