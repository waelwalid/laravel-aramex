<?php
namespace WaelWalid\LaravelAramex ;
use SoapClient;
/**
 * @author Wael Walid
 * @date 12-Nov-2019
 */
class Aramex {
    private $clientOnfo;
    private $dir ;
    public function __construct()
    {
        $this->dir = "vendor/aramex/".env("AramexProduction");

        /** set aramex client account data */
        $this->clientOnfo['AccountCountryCode'] = config("aramex.AccountCountryCode");
        $this->clientOnfo['AccountEntity'] = config("aramex.AccountEntity");
        $this->clientOnfo['AccountNumber'] = config("aramex.AccountNumber");
        $this->clientOnfo['AccountPin'] = config("aramex.AccountPin");
        $this->clientOnfo['UserName'] = config("aramex.UserName");
        $this->clientOnfo['Password'] = config("aramex.Password");
        $this->clientOnfo['Version'] = config("aramex.Version");
        $this->clientOnfo['City'] = config("aramex.City");
    }

    public function makeShipment($params) {

        $options = array(
            'cache_wsdl' => 0,
            'trace' => 1,
            'stream_context' => stream_context_create(array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            )));
        $soapClient = new SoapClient($this->dir.'/shipping-services-api-wsdl.wsdl' , $options);

        try {

            return $auth_call = $soapClient->CreateShipments($params);

        } catch (SoapFault $fault) {
            return $fault ;
        }
    }

}
