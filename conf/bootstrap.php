<?php
// define project root directory path into variable
define("PROJECT_ROOT_PATH", __DIR__ . "/../");

// include main configuration file 
require_once PROJECT_ROOT_PATH . "/conf/config.php";

// include the base controller file 
require_once PROJECT_ROOT_PATH . "/controller/api/BaseController.php";

// include the use model file 
require_once PROJECT_ROOT_PATH . "/model/Product.php";
?>