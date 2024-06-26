<?php
class BaseController
{
    /** 
    * Get querystring params. 
    * 
    * @return array 
    */
    protected function getQueryStringParams()
    {
        return parse_str($_SERVER['QUERY_STRING'], $query);
    }
    
    /** 
    * Send API output. 
    * 
    * @param mixed $data 
    * @param string $httpHeader 
    */
    protected function sendOutput($data, $httpHeaders=array())
    {
        header_remove('Set-Cookie');
        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }
        echo $data;
        exit;
    }
}