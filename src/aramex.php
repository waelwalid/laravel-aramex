<?php

namespace WaelWalid\LaravelAramex;

class Aramex
{


    public function rate_calculator()
    {

        $AccountCountryCode = "kw";
        $AccountEntity = "kwi";
        $AccountNumber = "203615";
        $AccountPin = "664165";
        $UserName = "testingapi@aramex.com";
        $Password = "R123456789$r";
        $Version = "v1.0";
        $City = "Kuwait City";
        $Weightunit = "KG";
        $mode = 0;

        if ($mode == 1)
            $fold = "/vendor/aramex/live/";
        else {
            $fold = "/vendor/aramex/test//";
        }

        $destination_country = "kw";
        $destination_city = "Abbasiyah";

        $tot_weight = .200;
        $qty = 1;

        //print_r($tot_weight." ".$qty);
        $params = array(
            'ClientInfo' => array(
                'AccountCountryCode' => $AccountCountryCode,
                'AccountEntity' => $AccountEntity,
                'AccountNumber' => $AccountNumber,
                'AccountPin' => $AccountPin,
                'UserName' => $UserName,
                'Password' => $Password,
                'Version' => $Version
            ),

            'Transaction' => array(
                'Reference1' => '001'
            ),

            'OriginAddress' => array(
                'City' => $City,
                'CountryCode' => $AccountCountryCode
            ),

            'DestinationAddress' => array(
                'City' => $destination_city,
                'CountryCode' => $destination_country
            ),
            'ShipmentDetails' => array(
                'PaymentType' => 'P',
                'ProductGroup' => 'EXP',
                'ProductType' => 'PPX',
                'ActualWeight' => array('Value' => $tot_weight, 'Unit' => $Weightunit),
                'ChargeableWeight' => array('Value' => $tot_weight, 'Unit' => $Weightunit),
                'NumberOfPieces' => $qty
            )
        );

        $soapClient = new SoapClient(base_url($fold . 'aramex-rates-calculator-wsdl.wsdl'), array('trace' => 1));
        $results = $soapClient->CalculateRate($params);
        print_r($results->TotalAmount->Value);

    }

    public function fetch_city($country_code = "", $search = "")
    {

        $AccountCountryCode = "kw";
        $AccountEntity = "kwi";
        $AccountNumber = "203615";
        $AccountPin = "664165";
        $UserName = "testingapi@aramex.com";
        $Password = "R123456789";
        $Version = "v1.0";
        $City = "Kuwait City";
        $Weightunit = "KG";
        $mode = 0;
        if ($mode == 1)
            $fold = "/vendor/aramex/live/";
        else {
            $fold = "/vendor/aramex/test/";
        }
        $params = array(
            'ClientInfo' => array(
                'AccountCountryCode' => $AccountCountryCode,
                'AccountEntity' => $AccountEntity,
                'AccountNumber' => $AccountNumber,
                'AccountPin' => $AccountPin,
                'UserName' => $UserName,
                'Password' => $Password,
                'Version' => $Version,
                'Source' => NULL
            ),

            'Transaction' => array(
                'Reference1' => '001'
            ),
            'CountryCode' => "kw",

            'State' => NULL,

            'NameStartsWith' => ""
        );

        try {
            $opts = array(
                'http' => array(
                    'user_agent' => 'PHPSoapClient',
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $context = stream_context_create($opts);

            $wsdlUrl = url($fold . 'Location-API-WSDL.wsdl');
            $soapClientOptions = array(
                'stream_context' => $context,
                'cache_wsdl' => WSDL_CACHE_NONE
            );

           // libxml_disable_entity_loader(false);

            $client = new \SoapClient($wsdlUrl, $soapClientOptions);

            return $client ;
//            $results = $client->a($params);
//            print_r($results);
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }


    }

    public function shipping_services()
    {


        $AccountCountryCode = "kw";
        $AccountEntity = "kwi";
        $AccountNumber = "203615";
        $AccountPin = "664165";
        $UserName = "testingapi@aramex.com";
        $Password = "R123456789$r";
        $Version = "v1.0";
        $City = "Kuwait City";
        $Weightunit = "KG";
        $mode = 0;
        $name = "Sanesh Sivan";
        $company = "DSC Technology";
        $phone = "+96567090413";
        $mobile = "+96567090413";
        $email = "saneshsivan@gmail.com";
        $location = "Kuwait City";

        if ($mode == 1)
            $fold = "/vendor/aramex/live/";
        else {
            $fold = "/vendor/aramex/test/";
        }
        $i = 0;
        $tot_qty = 0.200;
        $tot_weight = 1;

        $country_code = "kw";
        $params = array(
            'Shipments' => array(
                'Shipment' => array(
                    'Shipper' => array(
                        'Reference1' => '',
                        'Reference2' => '',
                        'AccountNumber' => $AccountNumber,
                        'PartyAddress' => array(
                            'Line1' => $City,
                            'Line2' => '',
                            'Line3' => '',
                            'City' => $City,
                            'StateOrProvinceCode' => '',
                            'PostCode' => '',
                            'CountryCode' => $AccountCountryCode
                        ),
                        'Contact' => array(
                            'Department' => '',
                            'PersonName' => $name,
                            'Title' => '',
                            'CompanyName' => $company,
                            'PhoneNumber1' => $phone,
                            'PhoneNumber1Ext' => '',
                            'PhoneNumber2' => '',
                            'PhoneNumber2Ext' => '',
                            'FaxNumber' => '',
                            'CellPhone' => $mobile,
                            'EmailAddress' => $email,
                            'Type' => ''
                        ),
                    ),

                    'Consignee' => array(
                        'Reference1' => 1,
                        'Reference2' => '',
                        'AccountNumber' => '',
                        'PartyAddress' => array(
                            'Line1' => "Home",
                            'Line2' => 'Flat No 1',
                            'Line3' => "Near AL Hamra Tower",
                            'City' => "Abbasiyah",
                            'StateOrProvinceCode' => '',
                            'PostCode' => "12345",
                            'CountryCode' => "kw"
                        ),

                        'Contact' => array(
                            'Department' => '',
                            'PersonName' => "Sanesh",
                            'Title' => '',
                            'CompanyName' => "DSC",
                            'PhoneNumber1' => "+96567090413",
                            'PhoneNumber1Ext' => '',
                            'PhoneNumber2' => '',
                            'PhoneNumber2Ext' => '',
                            'FaxNumber' => '',
                            'CellPhone' => "+96567090413",
                            'EmailAddress' => "saneshsivan@gmail.com",
                            'Type' => ''
                        ),
                    ),

                    'ThirdParty' => array(
                        'Reference1' => '',
                        'Reference2' => '',
                        'AccountNumber' => '',
                        'PartyAddress' => array(
                            'Line1' => '',
                            'Line2' => '',
                            'Line3' => '',
                            'City' => '',
                            'StateOrProvinceCode' => '',
                            'PostCode' => '',
                            'CountryCode' => ''
                        ),
                        'Contact' => array(
                            'Department' => '',
                            'PersonName' => '',
                            'Title' => '',
                            'CompanyName' => '',
                            'PhoneNumber1' => '',
                            'PhoneNumber1Ext' => '',
                            'PhoneNumber2' => '',
                            'PhoneNumber2Ext' => '',
                            'FaxNumber' => '',
                            'CellPhone' => '',
                            'EmailAddress' => '',
                            'Type' => ''
                        ),
                    ),

                    'Reference1' => "1",
                    'Reference2' => '',
                    'Reference3' => '',
                    'ForeignHAWB' => '',
                    'TransportType' => 0,
                    'ShippingDateTime' => time(),
                    'DueDate' => time(),
                    'PickupLocation' => $location,
                    'PickupGUID' => '',
                    'Comments' => "",
                    'AccountingInstrcutions' => '',
                    'OperationsInstructions' => '',

                    'Details' => array(
                        'Dimensions' => array(
                            'Length' => "",
                            'Width' => "",
                            'Height' => "",
                            'Unit' => "cm",

                        ),

                        'ActualWeight' => array(
                            'Value' => $tot_weight,
                            'Unit' => $Weightunit
                        ),

                        'ProductGroup' => 'EXP',
                        'ProductType' => 'PDX',
                        'PaymentType' => 'P',
                        'PaymentOptions' => '',
                        'Services' => '',
                        'NumberOfPieces' => $tot_qty,
                        'DescriptionOfGoods' => 'Docs',
                        'GoodsOriginCountry' => $AccountCountryCode,

                        'CashOnDeliveryAmount' => array(
                            'Value' => 0,
                            'CurrencyCode' => ''
                        ),

                        'InsuranceAmount' => array(
                            'Value' => 0,
                            'CurrencyCode' => ''
                        ),

                        'CollectAmount' => array(
                            'Value' => 0,
                            'CurrencyCode' => ''
                        ),

                        'CashAdditionalAmount' => array(
                            'Value' => 0,
                            'CurrencyCode' => ''
                        ),

                        'CashAdditionalAmountDescription' => '',

                        'CustomsValueAmount' => array(
                            'Value' => 0,
                            'CurrencyCode' => ''
                        ),

                        'Items' => array()
                    ),
                ),
            ),

            'ClientInfo' => array(
                'AccountCountryCode' => $AccountCountryCode,
                'AccountEntity' => $AccountEntity,
                'AccountNumber' => $AccountNumber,
                'AccountPin' => $AccountPin,
                'UserName' => $UserName,
                'Password' => $Password,
                'Version' => $Version
            ),

            'Transaction' => array(
                'Reference1' => "1",
                'Reference2' => '',
                'Reference3' => '',
                'Reference4' => '',
                'Reference5' => '',
            ),
            'LabelInfo' => array(
                'ReportID' => 9201,
                'ReportType' => 'URL',
            ),
        );

        $params['Shipments']['Shipment']['Details']['Items'][] = array(
            'PackageType' => 'Box',
            'Quantity' => $tot_qty,
            'Weight' => array(
                'Value' => $tot_weight,
                'Unit' => $Weightunit,
            ),
            'Comments' => 'Docs',
            'Reference' => ''
        );

//echo '<pre>';
//	print_r($params);
//  die();
        $soapClient = new SoapClient(base_url($fold . 'shipping-services-api-wsdl.wsdl'));
        $arr[0] = "";
        $arr[1] = "";
        try {
            $auth_call = $soapClient->CreateShipments($params);
            $arr[0] = $auth_call->Shipments->ProcessedShipment->ID;
            $arr[1] = $auth_call->Shipments->ProcessedShipment->ShipmentLabel->LabelURL;

        } catch (SoapFault $fault) {
            $arr[0] = "";
            $arr[1] = "";
        }
        print_r($arr);

    }

    public function shipping_track($id = 123456)
    {

        $AccountCountryCode = "kw";
        $AccountEntity = "kwi";
        $AccountNumber = "203615";
        $AccountPin = "664165";
        $UserName = "testingapi@aramex.com";
        $Password = "R123456789$r";
        $Version = "v1.0";
        $City = "Kuwait City";
        $Weightunit = "KG";
        $mode = 0;
        if ($mode == 1)
            $fold = "/vendor/aramex/live/";
        else {
            $fold = "/test/";
        }
        $params = array(
            'ClientInfo' => array(
                'AccountCountryCode' => $AccountCountryCode,
                'AccountEntity' => $AccountEntity,
                'AccountNumber' => $AccountNumber,
                'AccountPin' => $AccountPin,
                'UserName' => $UserName,
                'Password' => $Password,
                'Version' => $Version
            ),

            'Transaction' => array(
                'Reference1' => '001'
            ),
            'Shipments' => array(
                $id
            )
        );

// calling the method and printing results
        $soapClient = new SoapClient(base_url($fold . 'shipments-tracking-api-wsdl.wsdl'));
        $arr[0] = "";
        $arr[1] = "";
        $arr[2] = "";
        try {
            $auth_call = $soapClient->TrackShipments($params);
            $arr[0] = $auth_call->TrackingResults->KeyValueOfstringArrayOfTrackingResultmFAkxlpY->Value->TrackingResult->UpdateDescription;
            $arr[1] = $auth_call->TrackingResults->KeyValueOfstringArrayOfTrackingResultmFAkxlpY->Value->TrackingResult->UpdateDateTime;
            $arr[2] = $auth_call->TrackingResults->KeyValueOfstringArrayOfTrackingResultmFAkxlpY->Value->TrackingResult->UpdateLocation;

        } catch (SoapFault $fault) {
            $arr[0] = "";
            $arr[1] = "";
            $arr[2] = "";
        }
        print_r($arr);
    }
}
