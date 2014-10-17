<?php
/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {

    //public $import = 'User';
    /**
     * Fields
     *
     * @var array
     */
    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
        'username' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 40, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'password' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'role' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => '1', 'unsigned' => false),
        'created' => array('type' => 'datetime', 'null' => true, 'default' =>  null),
        'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'last_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'phone' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11),
        'address' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 90, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 40, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'gender' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 1),
        'birth_date' => array('type' => 'date', 'null' => false, 'default' => null),
        'status' => array('type' => 'integer', 'null' => false, 'default' => 0),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1)
        ),
        'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
    );

    /**
     * Records
     *
     * @var array
     */
    //    public function init() {
    //    $this->records = array(
    public $records = array(
        array(
            'id' => 1,
            'username' => 'admin',
            'password' => '$2a$10$QsNPaOWnlwAxAbYyJRpFp.ZeQeE4lelnJsaSpE1MojOqS0EgaIW0m', // admin1
            'role' => '1',
            'created' => '0000-00-00 00:00:00',
            'modified' => '0000-00-00 00:00:00',
            'name' => 'admin',
            'last_name' => 'admin',
            'phone' => '0',
            'address' => 'Coronado',
            'email' => 'admin@test',
            'gender' => 'M',
            'birth_date' => '0000-00-00',
        ),
        array(
            'id' => 2,
            'username' => 'user',
            'password' => '$2a$10$qfQJOKQ89Ogh78OlbOe7f.CHWU.qJg5BOhsAxtv/bq/C0usvORZWa', 
            'role' => '0',
            'created' => '0000-00-01 00:00:01',
            'modified' => '0000-00-01 00:00:01',
            'name' => 'pedro',
            'last_name' => 'perez',
            'phone' => '89298282',
            'address' => 'Coronado',
            'email' => 'pedro@gmail.com',
            'gender' => 'M',
            'birth_date' => '1995-08-07',
        )
        // parent::init();
    );

}