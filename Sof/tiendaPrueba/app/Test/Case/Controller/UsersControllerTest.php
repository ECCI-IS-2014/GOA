<?php
App::uses('UsersController', 'Controller');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * ProductsController Test Case
 *
 */
class UsersControllerTest extends ControllerTestCase {

    var $name = 'Auth';
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


    public function testAdding() {
        $data = array(
            'User' => array(
                'username' => 'mich',
                'password' => '123456', // admin1
                'role' => '0',
                'created' => '0000-00-00 00:00:00',
                'modified' => '0000-00-00 00:00:00',
                'name' => '',
                'last_name' => '',
                'phone' => '0',
                'address' => '',
                'email' => '',
                'gender' => '',
                'birth_date' => '0000-00-00'
            )
        );
        $this->testAction('/users/add', array('data' => $data, 'method' => 'get'));
        // some assertions.
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
        //$result = $this->testAction('/users/delete');
       // debug($result);
        /*
         * $this->assertFalse($this->User->testAction('/users/delete'));
            $this->assertFalse($this->User->exists(true));
         */
    }

}