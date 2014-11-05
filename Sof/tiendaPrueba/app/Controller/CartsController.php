<?php
App::uses('AppController', 'Controller');

class CartsController extends AppController {


    public $components = array('Paginator', 'Session');
    public $uses = array('Product','Cart');
    public $helpers = array('CatalogGenerator', 'Html');

    public function index() {
        $cart = $this->Session->read('cart');
        $numProducts = $this->Session->read('numProducts');
        $totalCartProducts = 0;
        
        $cart_Ids = array();

        for( $i = 0; $i < count($cart); $i++ ) {
            $product = $this->Product->find('first', array('conditions'=>array('Product.id'=>$cart[$i])));
            array_push($cart_Ids,$product);
            if ( $i > 0 ) {
                if ( $i > 0 && $product['Product']['enable_product'] == 0 ) {
                    // Revisa que el producto no haya sido deshabilitado
                    $numProducts[$i] = 0;
                    $this->Session->write('numProducts',$numProducts);
                } elseif( $product['Product']['quantity'] < $numProducts[$i] ) {
                    // Mantiene la cantidad de productos por comprar limitada por la quantity del producto
                    $numProducts[$i] = $product['Product']['quantity'];
                    $this->Session->write('numProducts',$numProducts);
                }
            }
            $totalCartProducts = $totalCartProducts + $numProducts[$i];
        }

        $this->Session->write('totalCartProducts',$totalCartProducts);

        $this->set('totalCartProducts',$totalCartProducts);
        $this->set('prodCarts',$cart_Ids);
        $this->set('numProducts',$numProducts);

    }

    //lee el array de session le concatena al final el nuevo producto y lo guarda en session de nuevo
    public function add() {

        $prod_id = $this->passedArgs['id'];
        $cart = $this->Session->read('cart');
        $numProducts = $this->Session->read('numProducts');
        $totalCartProducts = $this->Session->read('totalCartProducts');

        $product = $this->Product->find('first', array('conditions'=>array('Product.id'=>$prod_id)));

        $pos = array_search($prod_id,$cart);
        if ( $pos == false ) {
            // El producto no se encuentra en el carrito

            if ( $product['Product']['quantity'] == 0 || $product['Product']['enable_product'] == 0 ) {
                // El producto se acabo o no esta disponible
                $this->Session->setFlash(__('The product is not available and was not added to your cart.'));
            } else {
                // Agregar un nuevo producto al carrito
                array_push($cart,$prod_id);
                array_push($numProducts,1);
                $totalCartProducts = $totalCartProducts + 1;

                $this->Session->write('cart',$cart);
                $this->Session->write('numProducts',$numProducts);
                $this->Session->write('totalCartProducts',$totalCartProducts);

                //$this->Session->setFlash(__('The product has been added to your cart.'));
            }
            
        } else {
            // El producto ya esta en el carrito

            if ( $product['Product']['quantity'] <= $numProducts[$pos] ) {
                //No se pueden agregar mas productos porque ya no hay
                $numProducts[$pos] = $product['Product']['quantity'];
                $this->Session->write('numProducts',$numProducts);

                $this->Session->setFlash(__('The product has no more stock and was not added to your cart.'));
            } elseif ( $product['Product']['quantity'] == 0 || $product['Product']['enable_product'] == 0 ) {
                // El producto se acabo o no esta disponible
                $this->Session->setFlash(__('The product is not available and was not added to your cart.'));
            } else {
                // Se le agrega un producto a la cantidad del producto por comprar
                $numProducts[$pos] = $numProducts[$pos] + 1;
                $totalCartProducts = $totalCartProducts + 1;

                $this->Session->write('numProducts',$numProducts);
                $this->Session->write('totalCartProducts',$totalCartProducts);

                //$this->Session->setFlash(__('One more product has been added to your cart.'));
            }

        }      
        
        return $this->redirect(array('controller' => 'Products', 'action' => 'productInside','id'=>$prod_id));

    }

    //en este metodo parto el array en dos pedazos excluyendo de ambos el indice del elemento que quiero que deje de estar en el array y luego los uno y guardo el nuevo array en session
    public function delete() {
        $prod_id = $this->passedArgs['id'];
        $cart = $this->Session->read('cart');
        $numProducts = $this->Session->read('numProducts');

        $pos = array_search($prod_id,$cart);

        $first_cart = array_slice($cart, 0, $pos);
        $second_cart = array_slice($cart, $pos+1);
        $first_num = array_slice($numProducts, 0, $pos);
        $second_num = array_slice($numProducts, $pos+1);

        for($i = 0; $i<count($second_cart);$i++) {
            array_push($first_cart,$second_cart[$i]);
            array_push($first_num,$second_num[$i]);
        }

        $this->Session->write('cart',$first_cart);
        $this->Session->write('numProducts',$first_num);

        return $this->redirect(array('controller' => 'carts', 'action' => 'index'));
    }

    public function edit($id = null) {
        $cart = $this->Session->read('cart');
        $numProducts = $this->Session->read('numProducts');

        $pos = array_search($id,$cart);
        if ( $pos != false ) {
            if ($this->request->is(array('post', 'put'))) {
                $data = $this->request->data;
                $numProducts[$pos] = $data['cantidad'];
            } 
        }
        $this->Session->write('numProducts',$numProducts);

        return $this->redirect(array('controller' => 'carts', 'action' => 'index'));
        
    }

}

