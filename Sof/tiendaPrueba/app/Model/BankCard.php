<?php
App::uses('AppModel', 'Model');
/**
 * Card Model
 *
 */
class BankCard extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'expiration_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'card_holder' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'card_brand' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

    //obtiene el total de la cuenta y el numero de tarjeta al que hay que reducirle el saldo. Devuelve falso si la operacion tuvo algun problema
    public function balance_decrease($bill,$card_number)
    {

        $result = false;
        $conditions = array('BankCard.id'=>$card_number);
        if($this->hasAny($conditions))
        {

            $card = $this->find('first',array('conditions'=>array('BankCard.id'=>$card_number)) );
            $money_left = $card['BankCard']['balance'];
            if($money_left>$bill&&$this->verify_expiration($card['BankCard']['expiration_date']))
            {
                $money_left = $money_left - $bill;
                $this->id = $card_number;
                $this->saveField('balance', $money_left);
                $result = true;
            }
        }
        return $result;
    }

    //recibe la fecha de vencimiento y devuelve un true si aun NO expira o un false si ya expiro
    public function verify_expiration($exp_date)
    {
        $valid = false;

        $todays_date = date("Y-m-d");
        $today = strtotime($todays_date);
        $expiration_date = strtotime($exp_date);
        if ($expiration_date > $today)
        {
            $valid = true;
        }

        return $valid;
    }

    public function verify_name($card_holder_EF,$card_holder_store)
    {
        $result = false;
        if($card_holder_EF===$card_holder_store)
        {
            $result = true;
        }
        return $result;
    }

    public function verify_brand($card_brand_EF,$card_brand)
    {
        $result = false;
        if($card_brand_EF===$card_brand)
        {
            $result = true;
        }
        return $result;
    }
	
	public function verify_expiration_date($card_expiration_date_EF,$card_expiration_date_store)
    {
        $result = false;
        if($card_expiration_date_EF===$card_expiration_date_store)
        {
            $result = true;
        }
        return $result;
    }

    //devuelve un true si la informacion es correcta
    public function verify_information($card_number,$card_holder,$card_brand,$card_expiration)
    {
        $result = false;
        $conditions = array('BankCard.id'=>$card_number);
        if($this->hasAny($conditions))
        {
            $card = $this->find('first',array('conditions'=>array('BankCard.id'=>$card_number)) );
            if( $this->verify_brand($card_brand,$card['BankCard']['card_brand']) && $this->verify_name($card_holder,$card['BankCard']['card_holder']) && $this->verify_expiration_date($card_expiration,$card['BankCard']['expiration_date']) )
            {
                $result = true;
            }
        }
        return $result;
    }



}
