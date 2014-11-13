<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'ProductSales');
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
    public $uses = array('Sale','Product','Cart','CreditCard','ProductSale','User');

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->Sale->recursive = 0;
        $this->set('sales', $this->Paginator->paginate());
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


    // index de factura practicamente
    public function checkout() {

        if ($this->Session->read('flag') == 0) {
            $saleCart = $this->Session->read('cart');
        } else {
            $saleCart = $this->Session->read('saleCart');
        }
        $this->Session->write('flag',1);
        $this->Session->write('saleCart',$saleCart);
        $numProducts = $this->Session->read('numProducts');
		$fclient=$this->Session->read('Auth.User.frecuent_client');
        $this->Session->write('numProductsSaleCart',$numProducts);
        $totalCartProducts = 0;
        $cart_Ids = array();

        for( $i = 0; $i < count($saleCart); $i++ ) {
            $product = $this->Product->find('first', array('conditions'=>array('Product.id'=>$saleCart[$i])));
            array_push($cart_Ids,$product);
            if ( $i > 0 ) {
                if ( $i > 0 && $product['Product']['enable_product'] == 0 ) {
                    // Revisa que el producto no haya sido deshabilitado
                    $numProducts[$i] = 0;
                    $this->Session->write('numProductsSaleCart',$numProducts);
                } elseif( $product['Product']['quantity'] < $numProducts[$i] ) {
                    // Mantiene la cantidad de productos por comprar limitada por la quantity del producto
                    $numProducts[$i] = $product['Product']['quantity'];
                    $this->Session->write('numProductsSaleCart',$numProducts);
                }
            }
            $totalCartProducts = $totalCartProducts + $numProducts[$i];
        }
        $this->Session->write('totalSaleCartProducts',$totalCartProducts);

        $this->set('totalCartProducts',$totalCartProducts);
        $this->set('prodCarts',$cart_Ids);
        $this->set('numProducts',$numProducts);
		$this->set('fclient',$fclient);
		$this->check_frequentcy();
    }



/**
 * add method
 *
 * @return void
 */
    public function add($subtotal = 0.0, $tax = 0.0,  $frequenly_costumer_discount = 0.0, $total= 0.0) {
        date_default_timezone_set('America/Costa_Rica');
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $method_payment_id = $data['cards'];
            $coin = $data['currency'];
            $user_id=$this->Session->read('Auth.User.id');

            switch($coin){
                case '1':
                    $coin = 'Dollar';
                    break;
                case '2':
                    $coin = 'Euro';
                    $total = $total * 0.804547301;
                    $subtotal = $subtotal * 0.804547301;
                    $tax = $tax * 0.804547301;
                    break;
                case '3':
                    $coin = 'Colon';
                    $total = $total * 539.374326;
                    $subtotal = $subtotal * 539.374326;
                    $tax = $tax * 539.374326;
            }

            $data = array('user_id' => $user_id,'method_payment_id' => $method_payment_id, 'subtotal' =>  round($subtotal,2), 'frequenly_costumer_discount' => $frequenly_costumer_discount, 'total' => round($total,2), 'currency' => $coin, 'tax' => round($tax,2));
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
        $this->Session->write('flag',0);
        $sale_id=$this->Session->read('sale_id');
        $options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $sale_id));
        $sale = $this->Sale->find('first', $options);
        $this->set('sale', $sale);
        $payment_method = $this->CreditCard->find('first', array('conditions'=>array('CreditCard.id'=>$sale['Sale']['method_payment_id'])));
        $this->set('payment_method', $payment_method);

        // proce checkout
        $cart = $this->Session->read('saleCart');
        $numProducts = $this->Session->read('numProductsSaleCart');
        $totalCartProducts = 0;
        $cart_Ids = array();

        for( $i = 0; $i < count($cart); $i++ ) {
            $product = $this->Product->find('first', array('conditions'=>array('Product.id'=>$cart[$i])));
            array_push($cart_Ids,$product);
            if ( $i > 0 ) {
                if ( $i > 0 && $product['Product']['enable_product'] == 0 ) {
                    // Revisa que el producto no haya sido deshabilitado
                    $numProducts[$i] = 0;
                    $this->Session->write('numProductsSaleCart',$numProducts);
                } elseif( $product['Product']['quantity'] < $numProducts[$i] ) {
                    // Mantiene la cantidad de productos por comprar limitada por la quantity del producto
                    $numProducts[$i] = $product['Product']['quantity'];
                    $this->Session->write('numProductsSaleCart',$numProducts);
                }
            }
            $totalCartProducts = $totalCartProducts + $numProducts[$i];
        }
        $this->Session->write('totalSaleCartProducts',$totalCartProducts);

        $this->set('totalCartProducts',$totalCartProducts);
        $this->set('prodCarts',$cart_Ids);
        $this->set('numProducts',$numProducts);

        // borra carrito luego de pagar
        $cart = array(0);
        $this->Session->write('cart',$cart);
        $numProducts = array(0);
        $this->Session->write('numProducts',$numProducts);
        $totalCartProducts = 0;
        $this->Session->write('totalCartProducts',$totalCartProducts);
        $this->Session->write('flag',0);


    }


    public function order () {
        $ProductSales = new ProductSalesController;
        $allProdBySales = $ProductSales->getProdsFacts();
        $this->set('allProdBySales', $allProdBySales);

        $allSales = $this->Sale->find('all',array('conditions'=>array('Sale.user_id'=>$this->Session->read('Auth.User.id')), 'order'=>array('Sale.id'=>'DESC')));
        $this->set('allSales', $allSales);
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
        $cart = $this->Session->read('saleCart');
        $numProducts = $this->Session->read('numProductsSaleCart');

        $pos = array_search($prod_id,$cart);

        $first_cart = array_slice($cart, 0, $pos);
        $second_cart = array_slice($cart, $pos+1);
        $first_num = array_slice($numProducts, 0, $pos);
        $second_num = array_slice($numProducts, $pos+1);

        for($i = 0; $i<count($second_cart);$i++) {
            array_push($first_cart,$second_cart[$i]);
            array_push($first_num,$second_num[$i]);
        }

        $this->Session->write('saleCart',$first_cart);
        $this->Session->write('numProductsSaleCart',$first_num);

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
        $uname=$this->Session->read('Auth.User.name');
        $ulast_name=$this->Session->read('Auth.User.last_name');

        if (!$id)
        {
            $this->Session->setFlash('Sorry, there was no property ID submitted.');
            $this->redirect(array('action'=>'buys'), null, true);
        }

        $datos_factura = $this->Sale->find('all',array('conditions'=>array('Sale.user_id'=>$this->Session->read('Auth.User.id')),'order'=>array('Sale.id'=>'DESC')));
        $vid=$datos_factura[0]['Sale']['id'];
        $vsubtotal=$datos_factura[0]['Sale']['subtotal'];
        $vfrequenly_costumer_discount=$datos_factura[0]['Sale']['frequenly_costumer_discount'];
        $vtotal=$datos_factura[0]['Sale']['total'];
        $vcreated=$datos_factura[0]['Sale']['created'];
        $vtax=$datos_factura[0]['Sale']['tax'];
        $vcurrency=$datos_factura[0]['Sale']['currency'];
        $i=0;

        $vproduct = $this->ProductSale->find('all',array('conditions'=>array('ProductSale.sale_id'=>$datos_factura[0]['Sale']['id']),'contain'=>array('Product'=>array('conditions'=>array('Product.id'=>'ProductSale.product_id')))));
        $quantity = $this->ProductSale->find('all',array('conditions'=>array('ProductSale.sale_id'=>$datos_factura[0]['Sale']['id'])));
        $credit = $this->CreditCard->find('all',array('conditions'=>array('CreditCard.id'=>$datos_factura[0]['Sale']['method_payment_id'])));
        $card=$credit[0]['CreditCard']['card_number'];

         switch($vcurrency){
             case 'Dollar':
                 $vcurrency = '$';
                 break;
             case 'Euro':
                 $vcurrency = '€';
                 break;
             case 'Colon':
                 $vcurrency = '¢';
         }


        $this->set('i', $i);
        $this->set('user_name', $uname);
        $this->set('user_last_name', $ulast_name);
        $this->set('quantity', $quantity);
        $this->set('vprod', $vproduct);
        $this->set('card', $card);
        $this->set('currency', $vcurrency);
        $this->set('factura_id', $vid);
        $this->set('credit', $credit);
        $this->set('subtotal', $vsubtotal);
        $this->set('frequenly_costumer_discount', $vfrequenly_costumer_discount);
        $this->set('total', $vtotal);
        $this->set('created', $vcreated);
        $this->set('tax', $vtax);

        $this->layout = 'pdf'; //this will use the pdf.ctp layout
        $this->render();
    }
	
}
