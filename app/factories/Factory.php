<?php  
class Factory{

    private static $factories = [];

    private function __construct(){}

    //give the factory type as same as it appears in the class name
    public static function getFactory($factory_type){

        if(!array_key_exists($factory_type,self::$factories)){
            self::$factories[$factory_type] = new $factory_type();
        }

        return self::$factories[$factory_type];
    }
}