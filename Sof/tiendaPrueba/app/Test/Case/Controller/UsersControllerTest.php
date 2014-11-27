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
        'app.user',
        'app.credit_card'
    );

    /**
     * testView method
     * only the administrator can access the view of all the user al ready register
     *
     * @return void
     */
    public function testView() {
        $result = $this->testAction('/users/view');
        debug($result);
    }

    /**
     * testAdding method
     * creating a user and passing it to the action
     * method get
     * @return void
     */

    public function testAdd() {
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
        $result = $this->testAction('/users/add', array('data' => $data, 'method' => 'get'));
        debug($result);
        $this->assertFalse(!empty($this->User->id));

    }


    /**
     * testEdit method
     * A user can't edit their information if is not logged in in the page first!
     * @return void
     */

    public function testEdit() {

        $result = $this->testAction('/users/profile/edit/1');
        $results = $this->headers['Location'];
        $expected = 'http://localhost/GOA/Sof/tiendaPrueba/users/login';
        // check redirect
        $this->assertEquals($results, $expected);
        debug($result);
    }

    /**
     * testDelete method
     * A delete user can only see the home page after deleted
     * @return void
     */

    public function testDelete() {
        $result = $this->testAction('/users/delete/1');
        $results = $this->headers['Location'];
        $expected = 'http://localhost/GOA/Sof/tiendaPrueba/Pages/home';
        // check redirect
        $this->assertEquals($results, $expected);
        debug($result);
        // check if delete
        //$this->User->id = 1;
        //$this->assertFalse($this->User->exists());
    }

    /**
     *
     *  method get of profile
     */

    public function testProfile() {
        $result = $this->testAction('/users/profile', array(
            'method' => 'get',
            'return' => 'contents'
        ));
        debug($result);
    }

    /**
     *
     *  method testLogin
     *
     */
	 public function testLogin(){
        $result = $this->testAction('/users/login');
        debug($result);
    }

    /**
     *
     *  method get of logout
     *
     */

    public function testLogout(){
        $result = $this->testAction('/users/logout', array("method" =>"get", "return" => "contents"));
        debug($result);
    }
	
	public function testDisable() {
		$Users = $this->generate('Users');
		$this->testAction('/users/disable/2');
		
		$user = $Users->User->read(null, 2);
		$this->assertEqual($user['User']['status'],'0');
	}
	
	public function testEnable() {
		$Users = $this->generate('Users');
		$this->testAction('/users/enable/2');
		
		$user = $Users->User->read(null, 2);
		$this->assertEqual($user['User']['status'], '1');
	}

}