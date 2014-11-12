<?php
App::uses('AppController', 'Controller');
/**
 * Sales Controller
 *
 * @property Sale $Sale
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SalesController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
    public $helpers = array('CatalogGenerator', 'StringFormatter', 'Html');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
    public $uses = array('Product','Cart', 'Sale', 'Credit_Card','ProductSale','User');
/**
 * index method
 *
 * @return void
 */

    public function index() {
        $this->Sale->recursive = 0;
        $this->set('sales', $this->Paginator->paginate());
    }


    // index de factura practicamente
    public function checkout() {
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
		$this->check_frequentcy();
    }


/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Sale->exists($id)) {
			throw new NotFoundException(__('Invalid sale'));
		}
		$options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $id));
		$this->set('sale', $this->Sale->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */


	public function add($subtotal = 0.0, $tax = 0.0, $total= 0.0) {
	 date_default_timezone_set('America/Costa_Rica');
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $method_payment_id = $data['cards'];
            $coin = $data['currency'];
            $user_id=$this->Session->read('Auth.User.id');
            $frequenly_costumer_discount = 0.0;

            switch($coin){
                case '1':
                    $coin = 'Dollar';
                break;
                case '2':
                    $coin = 'Euro';
                break;
                case '3':
                    $coin = 'Colon';
            }

            $data = array('user_id' => $user_id,'method_payment_id' => $method_payment_id, 'subtotal' =>  $subtotal, 'frequenly_costumer_discount' => $frequenly_costumer_discount, 'total' => $total, 'currency' => $coin, 'tax' => $tax);
            if ($this->Sale->save($data)) {
                $this->Session->write('sale_id',$this->Sale->id);
                $this->Session->setFlash(__('Thank you for buying in FutureStore, your products are on the way!'));
                return $this->redirect(array('controller' => 'Product_Sales', 'action' => 'pay'));
            } else {
                $this->Session->setFlash(__('The sale could not be saved. Please, try again.'));
            }
        }
        return $this->redirect(array('controller' => 'Sales', 'action' => 'checkout'));
	}

    public function buys() {
        // proced de buys
        $sale_id=$this->Session->read('sale_id');
        $options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $sale_id));
        $this->set('sale', $this->Sale->find('first', $options));

        // proce checkout
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

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 *
 */
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
        //$this->set('canti', $numProducts[$pos]);
    return $this->redirect(array('controller' => 'carts', 'action' => 'index'));

}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

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

        return $this->redirect(array('controller' => 'sales', 'action' => 'checkout'));
    }
	
	public function check_frequentcy(){
        date_default_timezone_set('America/Costa_Rica');
        $monthQuantity=3;
        $productQuantity=10;
        $entryCondition=true; //condición de mes encontrado
        $entryCondition1=true; //condición del vector query
        $cont=0;
        $i=0;
        $Fecha = mktime(0, 0, 0,date('m')-$monthQuantity+1, date('m'), date('Y'));
        $Fecha=date("Y-m", $Fecha);
        $query = $this->Sale->find('all',array('conditions'=>array('Sale.user_id'=>$this->Session->read('Auth.User.id'),'Sale.created >='=>$Fecha)));

       while($entryCondition && $cont < $monthQuantity){
           while($i<sizeof($query) && $entryCondition1 ){
               $yearMonth=$query[$i]['Sale']['created'];
               $Fecha = mktime(0, 0, 0,date('m')-$monthQuantity+1+$cont, date('m'), date('Y'));

                if(substr($yearMonth, 0, -12) != date("Y-m", $Fecha) ){
                    $i++;
                }else{
                    $entryCondition1=false;
                }
           }
           $entryCondition1=true;

           if($i>=sizeof($query)){
              $entryCondition=false;
            }else{$cont++;}
           $i++;
       }
        $i=0;
       if($cont == $monthQuantity){
        $entryCondition=true;
        $contProduct=0;

        while($i<sizeof($query) && $entryCondition){ //la condicion revisara si el mes alcanzo la cantidad de productos establecida
            $j=0;

            while($i<sizeof($query) && $contProduct>=$productQuantity  && substr($query[$i]['Sale']['created'], 0, -12)== substr($query[$i-1]['Sale']['created'], 0, -12)){
                $i++;
            }

            if($i<sizeof($query)){
                if($contProduct!=0 && substr($query[$i]['Sale']['created'], 0, -12)!= substr($query[$i-1]['Sale']['created'], 0, -12) ){//reinicia el contador si cambió el mes después de que se llegó a max de productos del mes pasado
                    $contProduct=0;
                }

                $productQuery = $this->ProductSale->find('all',array('conditions'=>array('ProductSale.sale_id'=>$query[$i]['Sale']['id'])));
                while($j<sizeof($productQuery) && $contProduct < $productQuantity ){

                    if($contProduct < $productQuantity){
                        $contProduct+= $productQuery[$j]['ProductSale']['quantity'];

                        $j++;
                    }
                }

                if($j>=sizeof($productQuery) && $contProduct < $productQuantity && ($i+1==sizeof($query) || substr($query[$i+1]['Sale']['created'], 0, -12)!= substr($query[$i]['Sale']['created'], 0, -12))){
                    $entryCondition=false;
                }else{
                    $i++;}

            }
        }
        }
        if($i>=sizeof($query)){ //condicion de cliente frecuente
            $this->User->query("UPDATE users SET frecuent_client = 1 WHERE id = ".$this->Session->read('Auth.User.id').";");

       }else{ //condicion de cliente no frecuente
            $this->User->query("UPDATE users SET frecuent_client = 0 WHERE id = ".$this->Session->read('Auth.User.id').";");

        }

    }
	
	 public function viewPdf(){
        $id=$this->Session->read('Auth.User.id');
        $uid=$this->Session->read('Auth.User.username');

        if (!$id)
        {
            $this->Session->setFlash('Sorry, there was no property ID submitted.');
            $this->redirect(array('action'=>'buys'), null, true);
        }

        $datos_factura = $this->Sale->find('all',array('conditions'=>array('Sale.user_id'=>$this->Session->read('Auth.User.id'))));
        $vid=$datos_factura[sizeof($datos_factura)-1]['Sale']['id'];
        $vmethod_payment_id=$datos_factura[sizeof($datos_factura)-1]['Sale']['method_payment_id'];
        $vsubtotal=$datos_factura[sizeof($datos_factura)-1]['Sale']['subtotal'];
        $vfrequenly_costumer_discount=$datos_factura[sizeof($datos_factura)-1]['Sale']['frequenly_costumer_discount'];
        $vtotal=$datos_factura[sizeof($datos_factura)-1]['Sale']['total'];
        $vcreated=$datos_factura[sizeof($datos_factura)-1]['Sale']['created'];
        $vtax=$datos_factura[sizeof($datos_factura)-1]['Sale']['tax'];
        $i=0;

        $vproduct = $this->ProductSale->find('all',array('conditions'=>array('ProductSale.sale_id'=>$datos_factura[sizeof($datos_factura)-1]['Sale']['id']),'contain'=>array('Product'=>array('conditions'=>array('Product.id'=>'ProductSale.product_id')))));

        $this->set('i', $i);
        $this->set('user_id', $uid);
        $this->set('vprod', $vproduct);
        $this->set('factura_id', $vid);
        $this->set('method_payment_id', $vmethod_payment_id);
        $this->set('subtotal', $vsubtotal);
        $this->set('frequenly_costumer_discount', $vfrequenly_costumer_discount);
        $this->set('total', $vtotal);
        $this->set('created', $vcreated);
        $this->set('tax', $vtax);

        $this->layout = 'pdf'; //this will use the pdf.ctp layout
        $this->render();
    }
	
}
