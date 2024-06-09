<?php
require_once PROJECT_ROOT_PATH . "/model/PrintFulApi.php";
class Product extends PrintFulApi
{
    /**
     *  Get product properties by productId
     * 
     *  @return array
     */
    public function getPropertiesForProduct($productId = '')
    {
       $requestUrl = $this->createUrl($productId);
       $response = $this->executeRequestToPrintFullApi($requestUrl, 'GET');
       return [$this -> getPropertyValues($response, 'color'), $this -> getPropertyValues($response, 'size')];
    }

    /**
     *  Get objects certain property values in object
     * 
     *  @return array 
     */
    private function getPropertyValues ($jsonString = '', $propertyToSelect = 'id')
    {
        $propertyValues = [];
        $responseObj = json_decode($jsonString);
        $dataContainerObj = $responseObj->data;
        foreach ((array)$dataContainerObj as $key => $value) {
            if ($key === $propertyToSelect){
                $propertyValues[] = $value;
            }
        }
        return $propertyValues;
    }
}