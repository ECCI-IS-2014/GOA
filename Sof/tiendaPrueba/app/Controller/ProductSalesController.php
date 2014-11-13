<?php
App::uses('AppController', 'Controller');
/**
 * ProductSales Controller
 *
 * @property ProductSale $ProductSale
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProductSalesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
    public $helpers = array('CatalogGenerator', 'StringFormatter', 'Html');
    public $uses = array('Product','Cart', 'Sale', 'CreditCard', 'ProductSale');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ProductSale->recursive = 0;
		$this->set('productSales', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProductSale->exists($id)) {
			throw new NotFoundException(__('Invalid product sale'));
		}
		$options = array('conditions' => array('ProductSale.' . $this->ProductSale->primaryKey => $id));
		$this->set('productSale', $this->ProductSale->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function pay() {
        $cart = $this->Session->read('saleCart');
        $sale_id=$this->Session->read('sale_id');
        $numProducts = $this->Session->read('numProductsSaleCart');
        for( $i = 1; $i < count($cart); $i++ ) {
            $product = $this->Product->find('first', array('conditions'=>array('Product.id'=>$cart[$i])));

            $this->ProductSale->query("INSERT INTO product_sales (sale_id,product_id,quantity, price,discount) VALUES(".$this->Session->read('sale_id').",".$product['Product']['id'].",".$numProducts[$i].",".$product['Product']['price'].",".$product['Product']['discount'].");");
       }

       // $options = array('conditions' => array('ProductSale.' . $this->ProductSale->sale_id => $sale_id));
        $productsFact = $this->ProductSale->find('all', array('conditions'=>array('ProductSale.sale_id'=>$sale_id)));
        $this->set('productSale', $productsFact);

        return $this->redirect(array('controller' => 'Sales', 'action' => 'buys'));
	}

}
