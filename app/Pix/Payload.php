<?php 

namespace App\Pix ;

Class Payload {
  /**
   * IDs do Payload do Pix
   * @var string
   */
  const ID_PAYLOAD_FORMAT_INDICATOR = '00';
  const ID_MERCHANT_ACCOUNT_INFORMATION = '26';
  const ID_MERCHANT_ACCOUNT_INFORMATION_GUI = '00';
  const ID_MERCHANT_ACCOUNT_INFORMATION_KEY = '01';
  const ID_MERCHANT_ACCOUNT_INFORMATION_DESCRIPTION = '02';
  const ID_MERCHANT_CATEGORY_CODE = '52';
  const ID_TRANSACTION_CURRENCY = '53';
  const ID_TRANSACTION_AMOUNT = '54';
  const ID_COUNTRY_CODE = '58';
  const ID_MERCHANT_NAME = '59';
  const ID_MERCHANT_CITY = '60';
  const ID_ADDITIONAL_DATA_FIELD_TEMPLATE = '62';
  const ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXID = '05';
  const ID_CRC16 = '63';

  /**  
   * Chave pix   
   * @var string
*/
  private $pixKey;

/**  
   * Descrição do Pagamento
   * @var string
*/
private $description;

/**  
   * Nome do titular da conta 
   * @var string
*/
private $merchantName;

/**  
   * Cidade do titular da conta 
   * @var string
*/
private $merchantCity;

/**  
   * Id da transação pix
   * @var string
*/
private $txid;

/**  
   * Valor da Transação 
   * @var string
*/
private $amount;

/**
 * Metodo responsavel por definir valor de $pixKey
 * @param string $pixKey
 */
public function setPixKey($pixKey){
    $this->pixKey = $pixKey;
    return $this;
}

/**
 * Metodo responsavel por definir valor de $description
 * @param string $description
 */
public function setdescription($description){
    $this->description = $description;
    return $this;
}

/**
 * Metodo responsavel por definir valor de $merchantName
 * @param string $merchantName
 */
public function setmerchantName($merchantName){
    $this->merchantName = $merchantName;
    return $this;
}

/**
 * Metodo responsavel por definir valor de $merchantCity
 * @param string $merchantCity
 */
public function setmerchantCity($merchantCity){
    $this->merchantCity = $merchantCity;
    return $this;
}

/**
 * Metodo responsavel por definir valor de $txid
 * @param string $txid
 */
public function settxid($txid){
    $this->txid = $txid;
    return $this;
}

/**
 * Metodo responsavel por definir valor de $amount
 * @param float $amount
 */
public function setamount($amount){
    $this->amount = (string)number_format($amount,2,'.','');
    return $this;
}

/**
 * Reponsavel por retornar o valor completo de um objeto do Payload
 * @param string $id
 * @param string $value
 * @return string $id.$size.$value 
 */
private function getValue ($id, $value){
$size = str_pad(strlen($value),2,'0',STR_PAD_LEFT);
return $id.$size.$value;
}

/**
 * Metodo Responsavel por retornar os valores completos da informção da Conta
 * @return string
 */
private function MerchantAccountInformation(){
//Dominio do Banco
$gui = $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_GUI,'br.gov.bcb.pix');
//Chave pix
$key = $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_KEY, $this->pixKey);
//Descrição do pagamento
$description = strlen($this->description) ? $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_DESCRIPTION, $this->description): '';
//Valor completo da conta
return $this ->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION, $gui.$key.$description);
}
/**
 * Metodo Responsavel por gerar o codigo completo do Payload do Pix
 * @return string
 */
public function getPayload() {
//Cria o Payload
    $payload = $this->getValue(self::ID_PAYLOAD_FORMAT_INDICATOR,'01').
               $this->getMerchantAccountInformation(). $this->getValue(self::ID_MERCHANT_CATEGORY_CODE,'0000').
               $this->getValue(self::ID_TRANSACTION_CURRENCY,'986')
    
return $payload;
}
}
