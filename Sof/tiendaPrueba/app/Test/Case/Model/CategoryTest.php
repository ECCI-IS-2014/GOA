<?php
App::uses('Category', 'Model');

class CategoryTest extends CakeTestCase {

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
     * setUp method
     *
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $this->Category = ClassRegistry::init('Category');
    }

    public function testListCategoriesBelowLevel3() {

        $result = $this->Category->listCategoriesBelowLevel3();

        $expected[1] = 'sombreros';
        $expected[2] = 'calzado';
        $expected[3] = 'tacones';

        $this->assertEquals( $result, $expected );

    }

    public function testListCategoriesBelowLevel3WithIgnore() {

        $result = $this->Category->listCategoriesBelowLevel3(2);

        $expected[1] = 'sombreros';
        $expected[3] = 'tacones';

        $this->assertEquals( $result, $expected );

    }

    public function testListCategoriesForHome() {

        $result = $this->Category->listCategoriesForHome();

        $expected[-1] = 'All Categories';
        $expected[1]  = 'sombreros';
        $expected[2]  = 'calzado';
        $expected[3]  = '- tacones';
        $expected[4]  = '- - pumps';

        $this->assertEquals( $result, $expected );

    }
 
    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown() {
        unset($this->Category);
        parent::tearDown();
    }
}

?>