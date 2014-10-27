<?php
App::uses('AppController', 'Controller');

class CartsController extends AppController {


    public $components = array('Paginator', 'Session');
    public $uses = array('Product');
    public $helpers = array('CatalogGenerator', 'Html');

    public function index() {
        $prodCarts = array();

        foreach($_SESSION as $valor) {
            $i = 1;

            if ( $i > 4 ) {
                array_push($prodCarts,$valor);
            }
            $i++;
        }
        unset($valor);

        $this->set('prodCarts',$prodCarts);

    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $prod_id = $this->passedArgs['id'];

        try {
            if ($this->Session->$_SESSION[$prod_id + 4 ] = $prod_id) {
                $this->redirect(
                    array('controller' => 'Products', 'action' => 'productInside','id'=>$prod_id)
                );
            } else {
                $this->Session->setFlash(__('The product could not be saved in your Cart. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Session->setFlash(__('This item was already in your Cart. If you want to increment product quantity please edit your Cart.'));
            return $this->redirect(array('controller' => 'Products', 'action' => 'productInside','id'=>$prod_id));

        }

    }

}

?>