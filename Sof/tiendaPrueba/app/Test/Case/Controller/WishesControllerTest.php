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

    public $components = array('Paginator', 'Session');
    public $uses = array('Product','Wish');

	public function testIndex() {
        $Wishes = $this->generate('Wishes', array(
            'components' => array(
                'Session'
            )
        ));
        $Wishes->Session->expects($this->any())->method('setFlash');
        $Products = $this->generate('Products', array(
            'components' => array(
                'Session'
            )
        ));
        $Products->Session->expects($this->any())->method('setFlash');
        // sacamos todos los wishes del user id = 1
        $wishes = $Wishes->Wish->find('all', array('conditions'=>array('Wish.user_id'=>1)));
        if ($wishes != null) {
            $expected = true;
        } else {
            $expected = false;
        }
        //primera prueba, find wishes
        $this->assertEquals(true, $expected);
        // segunda prueba cantidad de wishes
        $wishesPro = array();
        if (count($wishes) == 2) {
            $expected = true;
        } else {
            $expected = false;
        }
        $this->assertEquals(true, $expected);
    }


/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
        $Wishes = $this->generate('Wishes', array(
            'components' => array(
                'Session'
            )
        ));
        $Wishes->Session->expects($this->any())->method('setFlash');
        $prod_id = 4;
        $us_id = 2;
        $data = array('user_id' => $us_id,'product_id'=>$prod_id);
            if ($Wishes->Wish->save($data)) {
                $expected = true;
            } else {
                $expected = false;
            }
        $this->assertEquals(true, $expected);
	}


/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
        $Wishes = $this->generate('Wishes', array(
            'components' => array(
                'Session'
            )
        ));
        $Wishes->Session->expects($this->any())->method('setFlash');
        // borrando wish 3 con user id 2 y product id 3
        $result = $Wishes->Wish->delete(3);

        debug($result);
	}


}