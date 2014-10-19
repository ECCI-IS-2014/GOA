<?php
App::uses('UsersController', 'Controller');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('AppModel', 'Model');
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
    //public $name = 'Users';
    public $User = null;

    public function testIndex() {
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
        //$this->assertTrue(!empty($this->User->id));
        //$this->assertTrue($this->User->exists(True));

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
        $this->testAction('/users/delete/1');
        $results = $this->headers['Location'];
        $expected = 'http://localhost/GOA/Sof/tiendaPrueba/Pages/home';
        // check redirect
        $this->assertEquals($results, $expected);

        // check that it was deleted
        //$this->User->id = 1;
        //$this->assertFalse($this->Users->User->exists());
    }
}