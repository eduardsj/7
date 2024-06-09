<?php
class RequestController extends BaseController
{
    /** 
    * Get all products from Printful catalogV2 by product ID 
    */
    public function listProduct()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $requestParameters = $this->getQueryStringParams();
        if (in_array(strtoupper($requestMethod), API_SUPPORTED_REQUEST_METHODS)) {
            try {
                $productModel = new Product();
                $arrProperties = $productModel->getPropertiesForProduct($requestParameters['id']);
                $responseData = json_encode($arrProperties);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}