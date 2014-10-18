<?php
App::uses('UsersController', 'Controller');

/**
 * ProductsController Test Case
 *
 */
class UsersControllerTest extends ControllerTestCase {

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.user'
    );

    /**
     * testIndex method
     *
     * @return void
     */
    public function testIndex() {
        //$this->markTestIncomplete('testIndex not implemented.');
        $result = $this->testAction('/users/index');
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
        $result = $this->testAction('/users/add');
        debug($result);
    }

    /**
     * testEdit method
     *
     * @return void
     */
    public function testEdit() {
        $result = $this->testAction('/users/edit');
        debug($result);
    }

    /**
     * testDelete method
     *
     * @return void
     */
    public function testDelete() {
        /*$result = $this->testAction('/users/delete');
        debug($result);*/
    }

}