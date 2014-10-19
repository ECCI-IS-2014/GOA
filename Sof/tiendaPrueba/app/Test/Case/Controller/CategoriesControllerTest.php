<?php
App::uses('CategoriesController', 'Controller');

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
        debug($result);
    }

    /**
     * testView method
     *
     * @return void
     */
    public function testView() {
        $this->markTestIncomplete('testView not implemented.');
    }

    /**
     * testAdd method
     *
     * @return void
     */
    public function testAdd() {
        $result = $this->testAction('/categories/add');
        debug($result);
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

?>