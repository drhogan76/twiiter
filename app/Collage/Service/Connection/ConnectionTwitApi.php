<?php

namespace Collage\Service\Connection;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Config;

class ConnectionTwitApi {

    private static $inst;

    private function __construct() {      
       
    }
    

    private static function conn()
    {
        $config = Config::get('app.twitterApi');
        return new TwitterOAuth($config[0], $config[1], $config[2], $config[3]);
    }
    
    public static function connection() {
        if (self::$inst === null) {
            self::$inst = self::conn();
        }
        return self::$inst;
    }    
   

}
