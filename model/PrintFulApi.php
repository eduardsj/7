<?php
require './vendor/autoload.php';
require PROJECT_ROOT_PATH . "./interface/CacheInterface.php";

class PrintFulApi
{
    protected $url = null;
    protected $httpClient = null;
    protected $memcache_con = null;
    
    public function __construct()
    {
        try {
            $this->url = PRINT_FUL_URL;
            $this->httpClient = new GuzzleHttp\Client();
            $memcache_obj = new Memcache;
            $this->memcache_con = $memcache_obj->connect(MEMCACHE, MEMCACHE_PORT);
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

    /**
     * Store a mixed type value in cache for a certain amount of seconds.
     * Supported values should be scalar types and arrays.
     *
     * @param string $key
     * @param mixed $value
     * @param int $duration Duration in seconds
     * @return mixed
     */
    public function set(string $key, $value, int $duration)
    {
       try {
            $this->memcache_con->set($key, $value, false, MEMCACHE_TIME);
       } catch (Exception $e) {
            throw new Exception($e->getMessage()); 
       }
    }

    /**
     * Retrieve stored item.
     * Returns the same type as it was stored in.
     * Returns null if entry has expired.
     *
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key)
    {
        try {
           return $this->memcache_con->get($key);
       } catch (Exception $e) {
            throw new Exception($e->getMessage()); 
       }
    }
}