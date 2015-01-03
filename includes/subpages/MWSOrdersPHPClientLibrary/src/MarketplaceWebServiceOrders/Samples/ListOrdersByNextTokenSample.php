<?php
/*******************************************************************************
 * Copyright 2009-2014 Amazon Services. All Rights Reserved.
 * Licensed under the Apache License, Version 2.0 (the "License"); 
 *
 * You may not use this file except in compliance with the License. 
 * You may obtain a copy of the License at: http://aws.amazon.com/apache2.0
 * This file is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR 
 * CONDITIONS OF ANY KIND, either express or implied. See the License for the 
 * specific language governing permissions and limitations under the License.
 *******************************************************************************
 * PHP Version 5
 * @category Amazon
 * @package  Marketplace Web Service Orders
 * @version  2013-09-01
 * Library Version: 2014-10-20
 * Generated: Fri Oct 17 15:31:59 GMT 2014
 */

/**
 * List Orders By Next Token Sample
 */

require_once('.config.inc.php');

/************************************************************************
 * Instantiate Implementation of MarketplaceWebServiceOrders
 *
 * AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY constants
 * are defined in the .config.inc.php located in the same
 * directory as this sample
 ***********************************************************************/
// More endpoints are listed in the MWS Developer Guide
// North America:
$serviceUrl = "https://mws.amazonservices.com/Orders/2013-09-01";
// Europe
//$serviceUrl = "https://mws-eu.amazonservices.com/Orders/2013-09-01";
// Japan
//$serviceUrl = "https://mws.amazonservices.jp/Orders/2013-09-01";
// China
//$serviceUrl = "https://mws.amazonservices.com.cn/Orders/2013-09-01";


 $config = array (
   'ServiceURL' => $serviceUrl,
   'ProxyHost' => null,
   'ProxyPort' => -1,
   'ProxyUsername' => null,
   'ProxyPassword' => null,
   'MaxErrorRetry' => 3,
 );

 $service = new MarketplaceWebServiceOrders_Client(
        AWS_ACCESS_KEY_ID,
        AWS_SECRET_ACCESS_KEY,
        APPLICATION_NAME,
        APPLICATION_VERSION,
        $config);

/************************************************************************
 * Uncomment to try out Mock Service that simulates MarketplaceWebServiceOrders
 * responses without calling MarketplaceWebServiceOrders service.
 *
 * Responses are loaded from local XML files. You can tweak XML files to
 * experiment with various outputs during development
 *
 * XML files available under MarketplaceWebServiceOrders/Mock tree
 *
 ***********************************************************************/
 // $service = new MarketplaceWebServiceOrders_Mock();

/************************************************************************
 * Setup request parameters and uncomment invoke to try out
 * sample for List Orders By Next Token Action
 ***********************************************************************/
 // @TODO: set request. Action can be passed as MarketplaceWebServiceOrders_Model_ListOrdersByNextToken
 $request = new MarketplaceWebServiceOrders_Model_ListOrdersByNextTokenRequest();
 $request->setSellerId(MERCHANT_ID);
 $request->setNextToken('WwOi4rWLxbuaJqJYLDm0ZIfVkJJPpovRrfFaV8nhuz1K6Gdbm4OfXwCmMxH2xtHoqBXdLk4iogyhLzLeiQQz7/NvkBxEJ+8ReKoF7fcxF3QBuv7tvALmtiJ0wMvlylZkWQWPqGlbsnOf1o9BEOqRQY3zgbPZ5uRFEk6nr+5uYoMMtXAVK0PV9buZIF9n45mtnrZ4AbBdBTdY1MaGG0HdZTL+e+hAAtekFXPcZGi09dm5HmwX5IAmwKfxnqm3JqvZfwylPI5qZH4R/NauObWi0Voenh9ps2qNmNmeoQkNOgX8gFC3cVBDMtLw4eiMUgf9XlGatmY+YEIpVJAoCXmgidrKy+NmENd+qmM2BYOD6a92DYfEKY73JhLKhiSSbLvPj56e81weLjWPOVGaWZzYNN4f5qQowO4v');
 // object or array of parameters
 invokeListOrdersByNextToken($service, $request);

/**
  * Get List Orders By Next Token Action Sample
  * Gets competitive pricing and related information for a product identified by
  * the MarketplaceId and ASIN.
  *
  * @param MarketplaceWebServiceOrders_Interface $service instance of MarketplaceWebServiceOrders_Interface
  * @param mixed $request MarketplaceWebServiceOrders_Model_ListOrdersByNextToken or array of parameters
  */

  function invokeListOrdersByNextToken(MarketplaceWebServiceOrders_Interface $service, $request)
  {
      try {
		  echo "<pre>";
        $response = $service->ListOrdersByNextToken($request);
		
		print_r($response);
		die();

        echo ("Service Response\n");
        echo ("=============================================================================\n");

        $dom = new DOMDocument();
        $dom->loadXML($response->toXML());
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        echo $dom->saveXML();
        echo("ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "\n");

     } catch (MarketplaceWebServiceOrders_Exception $ex) {
        echo("Caught Exception: " . $ex->getMessage() . "\n");
        echo("Response Status Code: " . $ex->getStatusCode() . "\n");
        echo("Error Code: " . $ex->getErrorCode() . "\n");
        echo("Error Type: " . $ex->getErrorType() . "\n");
        echo("Request ID: " . $ex->getRequestId() . "\n");
        echo("XML: " . $ex->getXML() . "\n");
        echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
     }
 }
