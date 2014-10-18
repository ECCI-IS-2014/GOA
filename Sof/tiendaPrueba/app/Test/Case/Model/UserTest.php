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



    public function testBeforeSave() {
        $result = $this->User->beforeSave(array('id', 'username','password', 'role', 'created', 'modified', 'name', 'last_name', 'phone', 'address', 'email', 'gender', 'birth_date', 'status'));
        $expected = array(
            array('User' => array('id' => 1, 'username' => 'admin', 'password' => '123456', 'role' => '1', 'created' => '0000-00-00 00:00:00', 'modified' => '0000-00-00 00:00:00', 'name' => 'admin', 'last_name' => 'admin', 'phone' => '0', 'address' => 'Coronado', 'email' => 'admin@test.com', 'gender' => 'M', 'birth_date' => '0000-00-00', 'status' => '0')),
            array('User' => array('id' => 2, 'username' => 'user', 'password' => '123456', 'role' => '0', 'created' => '2007-03-18 10:41:23', 'modified' => '2007-03-18 10:43:31', 'name' => 'pedro', 'last_name' => 'perez', 'phone' => '89298282', 'address' => 'Coronado', 'email' => 'pedro@test.com', 'gender' => 'M', 'birth_date' => '1995-08-07', 'status' => '0'))
/*
 *             array('User' => array('id' => 1, 'username' => 'admin', 'password' => '$2a$10$QsNPaOWnlwAxAbYyJRpFp.ZeQeE4lelnJsaSpE1MojOqS0EgaIW0m', 'role' => '1', 'created' => '0000-00-00 00:00:00', 'modified' => '0000-00-00 00:00:00', 'name' => 'admin', 'last_name' => 'admin', 'phone' => '0', 'address' => 'Coronado', 'email' => 'admin@test', 'gender' => 'M', 'birth_date' => '0000-00-00', 'status' => '0')),
            array('User' => array('id' => 2, 'username' => 'user', 'password' => '$2a$10$qfQJOKQ89Ogh78OlbOe7f.CHWU.qJg5BOhsAxtv/bq/C0usvORZWa', 'role' => '0', 'created' => '2007-03-18 10:41:23', 'modified' => '2007-03-18 10:43:31', 'name' => 'pedro', 'last_name' => 'perez', 'phone' => '89298282', 'address' => 'Coronado', 'email' => 'pedro@gmail.com', 'gender' => 'M', 'birth_date' => '1995-08-07', 'status' => '0'))

 */
        );
        $this->assertEquals($expected, $result);
}

}