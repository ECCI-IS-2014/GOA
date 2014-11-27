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
		'app.user',
        'app.product_sale'
	);

    public $components = array('Paginator', 'Session');
    public $uses = array('Sale', 'Product_Sale');


	public function testCheckout() {

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

/*
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

	}

/**
 * test de seguimiento [tracking]  method
 *
 * @return void
 */
	public function testCheck_tracking() {
        $Sales = $this->generate('Sales', array(
            'components' => array(
                'Session'
            )
        ));

        $ProductSales = $this->generate('ProductSales', array(
            'components' => array(
                'Session'
            )
        ));


        // se probará que el user con id 1 tiene 2 facturas asociadas, ya hechas en fixtures
        $query = $Sales->Sale->find('all',array('conditions'=>array('Sale.user_id'=>1)));
        if ($query != null) {
            $expected = true;
        } else {
            $expected = false;
        }
        //primera prueba
        $this->assertEquals(true, $expected);

        // segunda prueba

       // se llama al metodo checkout con el id del usuario que queremos probar (en este caso nuestro usuario con id = 1)
        // para corroborar el metodo con sus facturas en fixture tenemos una factura en pasado a la fecha del servidor y
        // otra en un tiempo muy futuro al servidor

        $Sales->Sale = new SalesController();
        //$Sales->Sale->check_tracking(1);
        if ($query[0]['Sale']['tracking'] == "Committed") {
            $expected = true;
        } else {
            $expected = false;
        }
        // prueba del primer fixture con date pasada -> deberia estar entregada
        $this->assertEquals(true, $expected);

        if ($query[1]['Sale']['tracking'] == "Not dispatched") {
            $expected = true;
        } else {
            $expected = false;
        }
        // prueba del primer fixture con date futura -> deberia estar en Not dispatched
        $this->assertEquals(true, $expected);




    }




}
