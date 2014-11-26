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
    public $uses = array('Sale','Product','Cart','CreditCard','ProductSale','User','Address');


    // works like the index
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
        $addresses = $this->Address->find('all', array('conditions'=>array('Address.user_id'=>$this->Session->read('Auth.User.id'))));
        $this->set('addresses',$addresses);
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
            $address = $data['addressSelector'];
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

            $data = array('user_id' => $user_id,'method_payment_id' => $method_payment_id, 'subtotal' =>  round($subtotal,2), 'frequenly_costumer_discount' => $frequenly_costumer_discount, 'total' => round($total,2), 'currency' => $coin, 'tax' => round($tax,2), 'address_id' => $address);
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
        //modifica la tabla de sales para poner el costo del shipping usando tipo de cambios dolar->Colones a 530 y dolar->euro a 0.84
        $address = $this->Address->find('first', array('conditions'=>array('Address.id'=>$sale['Sale']['address_id'])));
        $this->set('address', $address);
        if($address['Address']['country']=='Costa Rica')
        {
            switch ($sale['Sale']['currency'])
            {
                case 'Dollar': $this->Sale->query("UPDATE sales SET shipping = 6.00 WHERE id = ".$sale['Sale']['id'].";");
                    break;
                case 'Euro': $this->Sale->query("UPDATE sales SET shipping = 4.80 WHERE id = ".$sale['Sale']['id'].";");
                    break;
                case 'Colon': $this->Sale->query("UPDATE sales SET shipping = 3180.00 WHERE id = ".$sale['Sale']['id'].";");
                    break;
                default: $this->Sale->query("UPDATE sales SET shipping = 0.00 WHERE id = ".$sale['Sale']['id'].";");
                    break;

            }
            //$this->Sale->query("UPDATE sales SET shipping = 6.00 WHERE id = ".$sale['Sale']['id'].";");
        }else
        {
            switch ($sale['Sale']['currency'])
            {
                case 'Dollar': $this->Sale->query("UPDATE sales SET shipping = 35.00 WHERE id = ".$sale['Sale']['id'].";");
                    break;
                case 'Euro': $this->Sale->query("UPDATE sales SET shipping = 28.00 WHERE id = ".$sale['Sale']['id'].";");
                    break;
                case 'Colon': $this->Sale->query("UPDATE sales SET shipping = 18.550 WHERE id = ".$sale['Sale']['id'].";");
                    break;
                default: $this->Sale->query("UPDATE sales SET shipping = 0.00 WHERE id = ".$sale['Sale']['id'].";");
            }
            //$this->Sale->query("UPDATE sales SET shipping = 30.00 WHERE id = ".$sale['Sale']['id'].";");
        }

        $shipping = $this->Sale->find('first', array('conditions'=>array('Sale.id'=>$sale['Sale']['id'])));
        $this->set('shipping', $shipping);


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

        $this->check_tracking();
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
        $vshipping=$datos_factura[0]['Sale']['shipping'];
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

          $Address=$this->Address->find('all',array('conditions'=>array('Address.id'=>$datos_factura[0]['Sale']['address_id'])));
          $country=$Address[0]['Address']['country'];
          $state=$Address[0]['Address']['state'];
          $city=$Address[0]['Address']['city'];
          $street=$Address[0]['Address']['street'];

        $this->set('i', $i);
        $this->set('country', $country);
        $this->set('state', $state);
        $this->set('city', $city);
        $this->set('street', $street);
        $this->set('shipping', $vshipping);
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


    public function check_tracking($idUser = null){
        date_default_timezone_set('America/Costa_Rica');


        if ($idUser == null) {
            $query = $this->Sale->find('all',array('conditions'=>array('Sale.user_id'=>$this->Session->read('Auth.User.id'))));
        } else {  // es una test
            $query = $this->Sale->find('all',array('conditions'=>array('Sale.user_id'=>1)));
        }

        for ($i=0; $i < sizeof($query); $i++) {
            $Address=$this->Address->find('all',array('conditions'=>array('Address.id'=>$query[$i]['Sale']['address_id'])));

            if($Address[0]['Address']['country']=='Costa Rica'){ //local
                $primera=1;
                $segunda=2;
            }else{ //internacional
                $primera=2;
                $segunda=4;
            }

           $fechafactura=$query[$i]['Sale']['created'];
            $fechafactura1 = mktime(substr($fechafactura, 11, 2), substr($fechafactura, 14, 2)+$primera, 0, substr($fechafactura, 5, 2), substr($fechafactura, 8, 2), substr($fechafactura, 0, 4));
            $fechafactura2 = mktime(substr($fechafactura, 11, 2), substr($fechafactura, 14, 2)+$segunda, 0, substr($fechafactura, 5, 2), substr($fechafactura, 8, 2), substr($fechafactura, 0, 4));
            $fechafactura11=date("Y-m-d H:i", $fechafactura1);
            $fechafactura22=date("Y-m-d H:i", $fechafactura2);
            $fechaSistema = date('Y-m-d H:i');


            if($fechaSistema < $fechafactura11)
            {
                $tracking = "Not dispatched";

            }elseif (($fechaSistema >= $fechafactura11) && ($fechaSistema<$fechafactura22)){

                $tracking = "mailBox";
            }else {
                $tracking = "Committed";

            }
            $this->Sale->query("UPDATE sales SET tracking='$tracking' WHERE id = ".$query[$i]['Sale']['id'].";");

        }
    }


	
}
