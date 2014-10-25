<?php
App::uses('Product', 'Model');

class ProductTest extends CakeTestCase {

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.category',
        'app.product',
        'app.rating'
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $this->Product = ClassRegistry::init('Product');
    }

    public function testGetAllProducts() {

        $products = $this->Product->getAllProducts(
            'price', 
            'DESC'
        );
        $this->assertCount( 4, $products );

    }

    public function testGetProductsByAttributeEquals() {

        $products = $this->Product->getProductsByAttributeEquals(
            'id', 
            '1', 
            'price', 
            'DESC'
        );
        $this->assertEquals( '1', $products[0]["Product"]["id"] );

        $products = $this->Product->getProductsByAttributeEquals(
            'name', 
            'fedora', 
            'name'
        );
        $this->assertEquals( 'fedora', $products[0]["Product"]["name"] );

        $products = $this->Product->getProductsByAttributeEquals(
            'category_id', 
            '2'
        );
        $this->assertCount( 3, $products );

    }

    public function testGetProductsByAttributeLike() {

        $products = $this->Product->getProductsByAttributeLike(
            'name', 
            'fed', 
            'price', 
            'DESC'
        );
        $this->assertEquals( 'fedora', $products[0]["Product"]["name"] );

        $products = $this->Product->getProductsByAttributeLike(
            'name', 
            'LIas', 
            'price'
        );
        $this->assertEquals( 'sandalias', $products[0]["Product"]["name"] );

        $products = $this->Product->getProductsByAttributeLike(
            'name', 
            'RRO'
        );
        $this->assertEquals( 'burros', $products[0]["Product"]["name"] );

    }

    public function testGetProductsByAttributeRange() {

        $products = $this->Product->getProductsByAttributeRange(
            'id', 
            '1',
            '3', 
            'price', 
            'DESC'
        );
        $this->assertCount( 3, $products );

        $products = $this->Product->getProductsByAttributeRange(
            'price', 
            '2000',
            '2500'
        );
        foreach ($products as $key => $prod) {
            $price = floatval($prod['Product']['price']);
            $this->assertTrue( $price >= 2000 && $price <= 2500 );
        }

    }

    public function testGetProductsByAttributeLesserEquals() {

        $products = $this->Product->getProductsByAttributeLesserEquals(
            'price', 
            '3000'
        );
        foreach ($products as $key => $prod) {
            $price = floatval($prod['Product']['price']);
            $this->assertTrue( $price <= 3000 );
        }

    }

    public function testGetProductsByAttributeGreaterEquals() {

        $products = $this->Product->getProductsByAttributeGreaterEquals(
            'price', 
            '3000'
        );
        foreach ($products as $key => $prod) {
            $price = floatval($prod['Product']['price']);
            $this->assertTrue( $price >= 3000 );
        }

    }

    public function testReplaceCategory() {

        $prod = $this->Product->read(null, 4);
        $this->assertEqual($prod['Product']['category_id'], 1);

        $this->Product->replaceCategory(1,3);
        $prod = $this->Product->read(null, 4);
        $this->assertEqual($prod['Product']['category_id'], 3);

    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown() {
        unset($this->Product);
        parent::tearDown();
    }
}

?>