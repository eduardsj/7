<?php
require './vendor/autoload.php' ;

class PrintFulApi
{
    protected $url = null;
    protected $httpClient = null;
    
    public function __construct()
    {
        try {
            $this->url = PRINT_FUL_URL;
            $this->httpClient = new GuzzleHttp\Client();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());   
        }			
    }

    /*
    *  Create request url
    *
    *   @return string
    */
    public function createUrl($id = '')
    {
        return str_replace("{id}", $id, $this->url);
    }

    /*
    *   Execute request to Printful api
    *
    *   @return mixed
    */
    public function executeRequestToPrintFullApi($requestString = '', $requestType = 'GET')
    {
        try {
            $request = $this->httpClient->createRequest($requestType, $requestString);
            $request->addHeader('Authorization', PRINT_FUL_KEY);
            return $this->httpClient->send($request);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());       
        }
    }
}