<?php

require_once 'BitcoinECDSA.php';
require_once 'settings.php';

class Bitcoin{

    protected $xpub = XPUB;
    protected $callback_url = CALLBACK_URL;
    protected $key = SECRET_KEY;

    public function __construct(){
    }

    // Генерация адреса через api v2 Blockchain
    public function GenRecAddress( $secret, $userid ){
        $my_callback_url = $this->callback_url .'?id='. $userid .'&secret='. $secret;
        $root_url = 'https://api.blockchain.info/v2/receive';
        $parameters = 'xpub=' .$this->xpub. '&callback=' .urlencode($my_callback_url). '&key=' .$this->key .'&gap_limit=200';
        $response = file_get_contents($root_url . '?' . $parameters);
        $object = json_decode($response);
        return $object->address;
    }

    // Создание invoice оплаты через api v2 Blockchain
    public function ReceivePayments( $address, $mail, $secret ){

        $my_callback_url = $this->callback_url .'?id='. $mail . '&secret=' .$secret;
        $root_url = 'https://api.blockchain.info/v2/receive/balance_update';
        return $this->request($root_url, array(
            "key" => $this->key,
            "addr" => $address,
            "callback" => $my_callback_url,
            "onNotification" => "KEEP",
            "op" => "RECEIVE",
            "confs" => 3
        ));
    }

    // Генерация адреса через библиотеку BitcoinECDSA
    public function GenAddress( $secret ){
        $bitcoinECDSA = new BitcoinECDSA();
        $bitcoinECDSA->generateRandomPrivateKey($secret);                 //generate new random private key
        $address = $bitcoinECDSA->getAddress();                           //compressed Bitcoin address
        $pubkey = $bitcoinECDSA->getPubKey();
        $privatekey = $bitcoinECDSA->getPrivateKey();
        $wif = $bitcoinECDSA->getWif();

        if( !$bitcoinECDSA->validateAddress($address) )
            return array(
                'Address' => '',
                'PubKey' => '',
                'PrivateKey' => '',
                'WIFKey' => ''
            );
        else
            return array(
                'Address' => $address,
                'PubKey' => $pubkey,
                'PrivateKey' => $privatekey,
                'WIFKey' => $wif
            );
    }

    // Отслеживание оплаты через api v1 Blockchain
    public function TrackReceivePayments( $address){
        $root_url = 'https://blockchain.info/rawaddr/'.$address.'?limit=1';
        $response = file_get_contents($root_url);
        $object = json_decode($response);
        return $object->txs;
    }

    // Получаем номер текущего блока через api v1 Blockchain
    public function CurrentBlock(){
        $now = new DateTime();
        $root_url = 'https://blockchain.info/blocks/'. $now->getTimestamp()*1000 .'?format=json';
        $response = file_get_contents($root_url);
        $object = json_decode($response);
        return $object->blocks[0]->height;
    }

    private function request($p_function, $p_parameters = array())
    {
        $l_curl = curl_init($p_function);
        curl_setopt($l_curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($l_curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($l_curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($l_curl, CURLOPT_POST, 'POST');
        curl_setopt($l_curl, CURLOPT_POSTFIELDS, json_encode($p_parameters));
        $l_curlResult = curl_exec($l_curl);
        if ($l_curlResult === false) return false;
        $dec = json_decode($l_curlResult, true);
        curl_close($l_curl);
        if (!$dec) {
            return false;
        } else {
            return $dec;
        }
    }

    public function delete($p_function, $p_parameters = array()){

        $post_data = '?';

        foreach($p_parameters as $k => $v){
            $post_data .= $k . '='.$v.'&';
        }

        $p_function .= rtrim($post_data, '&');
        $l_curl = curl_init();
        curl_setopt($l_curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($l_curl,CURLOPT_URL,$p_function);
        curl_setopt($l_curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($l_curl,CURLOPT_HEADER, false);

        $l_curlResult = curl_exec($l_curl);
        if ($l_curlResult === false) return false;
        $dec = json_decode($l_curlResult, true);
        curl_close($l_curl);
        if (!$dec) {
            return false;
        } else {
            return $dec->deleted;
        }

    }
}