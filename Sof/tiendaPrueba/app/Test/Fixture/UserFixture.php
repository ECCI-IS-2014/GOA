<?php
/**
 * UserFixture
 *
 */
App::uses('AuthComponent', 'Controller/Component');

class UserFixture extends CakeTestFixture {

    public $name = 'User';

    public $useDbConfig = 'test';
    /**
     * Fields
     *
     * @var array
     */
    public $fields = array(
        'id' => array('type' => 'integer', 'key' => 'primary'),
        'username' => array('type' => 'string', 'null' => false),
        'password' => array('type' => 'string', 'null' => false, 'length' => 255),
        'role' => array('type' => 'integer', 'null' => false, 'default' => '0'),
        'created' => array('type' => 'datetime'),
        'modified' => array('type' => 'datetime'),
        'name' => array('type' => 'string', 'null' => false),
        'last_name' => array('type' => 'string', 'null' => false),
        'phone' => array('type' => 'integer', 'null' => false,  'length' => 11),
        'address' => array('type' => 'string', 'null' => false,  'length' => 90),
        'email' => array('type' => 'string', 'null' => false,  'length' => 40),
        'gender' => array('type' => 'string', 'null' => false, 'length' => 1),
        'birth_date' => array('type' => 'date', 'null' => false),
        'status' => array('type' => 'integer', 'null' => false, 'default' => '1'),
        //'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
    );

    /**
     * Records
     *
     * @var array
     */

    public $records = array(
        array(
            'id' => 1,
            'username' => 'admin',
            'password' => '$2a$10$QsNPaOWnlwAxAbYyJRpFp.ZeQeE4lelnJsaSpE1MojOqS0EgaIW0m', // admin1
            'role' => '1',
            'created' => '0000-00-00 00:00:00',
            'modified' => '0000-00-00 00:00:00',
            'name' => '',
            'last_name' => '',
            'phone' => '0',
            'address' => '',
            'email' => '',
            'gender' => '',
            'birth_date' => '0000-00-00',
        ),
        array(
            'id' => 2,
            'username' => 'usuario',
            'password' => '$2a$10$qfQJOKQ89Ogh78OlbOe7f.CHWU.qJg5BOhsAxtv/bq/C0usvORZWa',
            'role' => '0',
            'created' => '2014-10-15 02:33:56',
            'modified' => '2014-10-15 02:33:56',
            'name' => 'Pepito',
            'last_name' => 'Perez Pereira',
            'phone' => '88888888',
            'address' => '200mts Norte del Palo de Mango',
            'email' => 'us@gmail.com',
            'gender' => 'F',
            'birth_date' => '1994-10-15',
        )
    );

}