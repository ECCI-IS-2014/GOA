<?php
App::uses('User', 'Model');
/**
 * User Test Case
 *
 */
class UserTest extends CakeTestCase {

    /**
     * Fixtures
     *
     * @var array
     */
  public $fixtures = array(
        'app.user'
    );

   // public $fixtures = array('user');

    public $User;
    /**
     * SetUp method
     *
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $this->User = ClassRegistry::init('User');
    }

    /**
     * TearDown method
     *
     * @return void
     */
    public function tearDown() {
        unset($this->User);

        parent::tearDown();
    }

    public function testGetInstance(){

        $created = $this->User->field('created', array('User.username' => 'usuario'));
        $this->assertEquals($created, '2014-10-15 02:33:56', 'Created Date');
    }


    function testChecking(){
        $password = $this->User->field('password', array('User.username' => 'admin'));
        $this->assertEquals($password,'$2a$10$QsNPaOWnlwAxAbYyJRpFp.ZeQeE4lelnJsaSpE1MojOqS0EgaIW0m');
    }


    public function testSave() {
        $data = array(
            'id' => '1',
            'username' => 'admin',
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
            'birth_date' => '0000-00-00',
            'status' => '1'
        );
        $result = $this->User->save($data);
        $this->assertTrue(!empty($this->User->id));
    }



    public function testBeforeSave() {

        $result = $this->User->beforeSave(//'User' // puede ponerse solo User, con info ya guardada en Fixtures
            array(
                'id' => '1',
                'username' => 'admin',
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
                'birth_date' => '0000-00-00',
                'status' => '1'
            )
        );

        $this->assertEquals($result, True);

}




}