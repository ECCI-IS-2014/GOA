<?php

App::uses('ProductsController', 'Controller');

/**
 * ProductsController Test Case
 *
 */
class ProductsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.category',
		'app.product',
		'app.rating'
	);

/**
 * testIndex method
 *
 * @return void
 */	
	public function testIndex() {
		$result = $this->testAction('/products/index');
		$this->assertInternalType('array', $this->vars['products']);
		debug($result);
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
		$result = $this->testAction('/users/view');
        debug($result);
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
		$Products = $this->generate('Products', array(
			'components' => array(
				'Session'
			)
		));
		$Products->Session->expects($this->any())->method('setFlash');
		
		$data = array(
			'Product' => array(
				'category_id' => '2',
				'name' => 'converse',
				'price' => '30000.00',
				'quantity' => '24',
				'description' => 'All Star.'
			),
			'Rating' => array(
				'enable_rating' => 1
			),
		);
		$this->testAction('/products/add', array('data' => $data));
		
		$this->assertContains('/products', $this->headers['Location']);
		
		$prod = $Products->Product->read(null, 5);
		$this->assertEqual($prod['Product']['name'], 'converse');
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
		$Products = $this->generate('Products', array(
			'components' => array(
				'Session'
			)
		));
		$Products->Session->expects($this->any())->method('setFlash');
		
		$data = array(
			'Product' => array(
				'id' => '3',
				'category_id' => '1',
				'name' => 'fedora',
				'price' => '10200.00',
				'quantity' => '7',
				'image' => '1413218846-1.jpg',
				'enable_product' => 1,
				'rating' => '0',
				'description' => 'Para hipsters.'
			)
		);
		$this->testAction('/products/edit/3', array('data' => $data));
		
		$prod = $Products->Product->read(null, 3);
		$this->assertEqual($prod['Product']['price'], '10200.00');
		$this->assertEqual($prod['Product']['description'], 'Para hipsters.');
	}

/**
 * testDisable method
 *
 * @return void
 */
	public function testDisable() {
		$Products = $this->generate('Products', array(
			'components' => array(
				'Session'
			)
		));
		$Products->Session->expects($this->any())->method('setFlash');
		
		$this->testAction('/products/disable/2');		// disable producto con id 2
		
		$prod = $Products->Product->read(null, 2);
		$this->assertEqual($prod['Product']['enable_product'], false);
	}

/**
 * testEnable method
 *
 * @return void
 */
	public function testEnable() {
		$Products = $this->generate('Products', array(
			'components' => array(
				'Session'
			)
		));
		$Products->Session->expects($this->any())->method('setFlash');
		
		$this->testAction('/products/enable/1');		// enable producto con id 1
		
		$prod = $Products->Product->read(null, 1);
		$this->assertEqual($prod['Product']['enable_product'], '1');
	}

}




