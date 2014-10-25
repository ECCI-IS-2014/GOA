<?php

App::uses('CategoriesController', 'Controller');

/**
 * CategoriesController Test Case
 *
 */
class CategoriesControllerTest extends ControllerTestCase {
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.category',
        'app.product'
    );

    /**
     * testIndex method
     *
     * @return void
     */
    public function testIndex() {
        $result = $this->testAction('/categories/index');
		$this->assertInternalType('array', $this->vars['categories']);
        debug($result);
    }

    /**
     * testView method
     *
     * @return void
     */
    public function testView() {
        $result = $this->testAction('/categories/view/1');
        debug($result);
    }

    /**
     * testAdd method
     *
     * @return void
     */
    public function testAdd() {
        $Categories = $this->generate('Categories', array(
			'components' => array(
				'Session'
			)
		));
		$Categories->Session->expects($this->any())->method('setFlash');
		
		$data = array(
			'Category' => array(
				'name' => 'bolsos',
				'father_category_id' => null
			),
		);
		$this->testAction('/categories/add', array('data' => $data));
		
		$this->assertContains('/categories', $this->headers['Location']);
		
		$cate = $Categories->Category->read(null, 5);
		$this->assertEqual($cate['Category']['name'], 'bolsos');
    }

    /**
     * testEdit method
     *
     * @return void
     */
    public function testEdit() {
        $Categories = $this->generate('Categories', array(
			'components' => array(
				'Session'
			)
		));
		$Categories->Session->expects($this->any())->method('setFlash');
		
		$data = array(
			'Category' => array(
				'id' => '2',
				'name' => 'zapatos',
				'father_category_id' => null
			),
		);
		
		// Pruebas antes del edit
		$cate = $Categories->Category->read(null, 2);
		$this->assertEqual($cate['Category']['name'], 'calzado');
		
		$this->testAction('/products/edit/2', array('data' => $data));
		
		// Pruebas despues del edit
		$cate = $Categories->Category->read(null, 2);
		$this->assertEqual($cate['Category']['name'], 'zapatos');
    }
}

?>