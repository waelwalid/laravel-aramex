# Laravel Aramex Integration!

This package to integrate your application with Aramex services

 1. Shipping - Done
 2. Tracking - Soon
 3. Rate calculation - Soon 

# Installation

You can install the package via composer:

    composer require waelwalid/laravel-aramex

## Config

    php artisan vendor:publish --tag=aramex

## .ENV File

    AramexProduction = "test" OR "live"

This command line will copy XML Files of Aramex Soap Service to public directory and config file named aramex.php into config directory.

**-- public/vendor/aramex | config/aramex.php**

    <?php
     return [
	    "client" => [
		    "AccountCountryCode" => "",
		    "AccountEntity" => "",
		    "AccountNumber" => "",
		    "AccountPin" => "",
		    "UserName" => "",
		    "Password" => "",
		    "Version" => "v1.0",
		    "City" => ""
		]
    ];
    
    ?>

## #Shipment Request Exmaple:

	$shipmentData = array(
	            'Shipments' => array(
	                'Shipment' => array(
	                    'Shipper'	=> array(
	                        'Reference1' 	=> "",
	                        'Reference2' 	=> "",
	                        'AccountNumber' => "",
	                        'PartyAddress'	=> array(
	                            'Line1'					=> "",
	                            'Line2' 				=> '',
	                            'Line3' 				=> '',
	                            'City'					=> '',
	                            'StateOrProvinceCode'	=> '',
	                            'PostCode'				=> '',
	                            'CountryCode'			=> ''
	                        ),
	                        'Contact'		=> array(
	                            'Department'			=> '',
	                            'PersonName'			=> '',
	                            'Title'					=> '',
	                            'CompanyName'			=> '',
	                            'PhoneNumber1'			=> '',
	                            'PhoneNumber1Ext'		=> '',
	                            'PhoneNumber2'			=> '',
	                            'PhoneNumber2Ext'		=> '',
	                            'FaxNumber'				=> '',
	                            'CellPhone'				=> '',
	                            'EmailAddress'			=> '',
	                            'Type'					=> ''
	                        ),
	                    ),

                    'Consignee'	=> array(

                        'Reference1'	=> '',
                        'Reference2'	=> '',
                        'AccountNumber' => '',
                        'PartyAddress'	=> array(
                            'Line1'					=> '',
                            'Line2'					=> '',
                            'Line3'					=> "",
                            'City'					=> '',
                            'StateOrProvinceCode'	=> '',
                            'PostCode'				=> "",
                            'CountryCode'			=> ''
                        ),

                        'Contact'		=> array(
                            'Department'			=> '',
                            'PersonName'			=> '',
                            'Title'					=> '',
                            'CompanyName'			=> "",
                            'PhoneNumber1'			=> '',
                            'PhoneNumber1Ext'		=> '',
                            'PhoneNumber2'			=> '',
                            'PhoneNumber2Ext'		=> '',
                            'FaxNumber'				=> '',
                            'CellPhone'				=> '',
                            'EmailAddress'			=> '',
                            'Type'					=> ''
                        ),
                    ),

                    'ThirdParty' => array(
                        'Reference1' 	=> '',
                        'Reference2' 	=> '',
                        'AccountNumber' => '',
                        'PartyAddress'	=> array(
                            'Line1'					=> '',
                            'Line2'					=> '',
                            'Line3'					=> '',
                            'City'					=> '',
                            'StateOrProvinceCode'	=> '',
                            'PostCode'				=> '',
                            'CountryCode'			=> ''
                        ),
                        'Contact'		=> array(
                            'Department'			=> '',
                            'PersonName'			=> '',
                            'Title'					=> '',
                            'CompanyName'			=> '',
                            'PhoneNumber1'			=> '',
                            'PhoneNumber1Ext'		=> '',
                            'PhoneNumber2'			=> '',
                            'PhoneNumber2Ext'		=> '',
                            'FaxNumber'				=> '',
                            'CellPhone'				=> '',
                            'EmailAddress'			=> '',
                            'Type'					=> ''
                        ),
                    ),

                    'Reference1' 				=> "1",
                    'Reference2' 				=> '',
                    'Reference3' 				=> '',
                    'ForeignHAWB'				=> '',
                    'TransportType'				=> 0,
                    'ShippingDateTime' 			=> time(),
                    'DueDate'					=> time(),
                    'PickupLocation'			=> '',
                    'PickupGUID'				=> '',
                    'Comments'					=> "",
                    'AccountingInstrcutions' 	=> '',
                    'OperationsInstructions'	=> '',

                    'Details' => array(
                        'Dimensions' => array(
                            'Length'				=> "",
                            'Width'					=> "",
                            'Height'				=> "",
                            'Unit'					=> "cm",

                        ),

                        'ActualWeight' => array(
                            'Value'					=> '',
                            'Unit'					=> ''
                        ),

                        'ProductGroup' 			=> 'EXP',
                        'ProductType'			=> 'PDX',
                        'PaymentType'			=> 'P',
                        'PaymentOptions' 		=> '',
                        'Services'				=> '',
                        'NumberOfPieces'		=>  1,
                        'DescriptionOfGoods' 	=> '',
                        'GoodsOriginCountry' 	=> '',

                        'CashOnDeliveryAmount' 	=> array(
                            'Value'					=> "",
                            'CurrencyCode'			=> ""
                        ),

                        'InsuranceAmount'		=> array(
                            'Value'					=> 0,
                            'CurrencyCode'			=> ''
                        ),

                        'CollectAmount'			=> array(
                            'Value'					=> "",
                            'CurrencyCode'			=> ""
                        ),

                        'CashAdditionalAmount'	=> array(
                            'Value'					=> 0,
                            'CurrencyCode'			=> ''
                        ),

                        'CashAdditionalAmountDescription' => '',

                        'CustomsValueAmount' => array(
                            'Value'					=> 0,
                            'CurrencyCode'			=> ''
                        ),

                        'Items' 				=> []
                    ),
                ),
            ),

            'ClientInfo'  			=> config("aramex.client"),

            'Transaction' 			=> array(
                'Reference1'			=> "1",
                'Reference2'			=> '',
                'Reference3'			=> '',
                'Reference4'			=> '',
                'Reference5'			=> '',
            ),
            'LabelInfo'				=> array(
                'ReportID' 				=> 9201,
                'ReportType'			=> 'URL',
            ),
        );
    -------------------------------------------------------------------------------------------

    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use WaelWalid\LaravelAramex\Aramex;
    
    class ShippingController extends Controller
    {
        public function index(Request $request){
            
            try{
                $aramex = new Aramex();
                $result = $aramex->makeShipment($shipmentData);
                echo "<pre>";
                print_r($result);
                //IF SUCCESS
                //$result->Shipments->ProcessedShipment->ID;
        		//$result->Shipments->ProcessedShipment->ShipmentLabel->LabelURL;
            }catch(\Exception $exception){
                return $exception->getMessage() ."in : ".$exception->getFile();
            }
    
        }
    }

## More information about params types and values

Please check Aramex soap service documentation via : 
[https://www.aramex.com/docs/default-source/resourses/resourcesdata/shipping-services-api-manual.pdf](https://www.aramex.com/docs/default-source/resourses/resourcesdata/shipping-services-api-manual.pdf)

