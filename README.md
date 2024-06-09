This is unfinished REST API example for Prinful API with memcache use for persistent file caching mechanism (5 minutes but can be changed via config.php file value). Main issues not setup environment on host machine (windows 11) issue with phpunit (cant load class code), memcache did not run properly even with enabled extension on host PHP, issues with token and Printful API (400 Bad request).

What was intended? API app accessible via url http://localhost/index.php/product/getPropertiesForProduct?id=12 (dynamic value for product id. 12 is gotten from task document as example). It can be run via "php -S localhost:8000" where 8000 can be any desired host machine free port. Host as well need to have php 8 version with enabled memcache for persistent file caching mechanism (5 minutes but can be changed via config.php file value) and as well running memcache task which will provide storage functionality for app and installed two composer frameworks phpunit and Guzzle


