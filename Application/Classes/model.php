<?php
class Model{
    public static function Get($module,$model){
        return require_once($_SERVER['DOCUMENT_ROOT']."/Modules/$module/Model/".strtolower($model).'.php');
    }
    
    public static function GetInstance($type){
        $credentials = self::GetCredentials($type);
        
        return new Database($credentials['username'], $credentials['password'], $credentials['host'], $credentials['db']);
    }
    
    public static function GetCredentials($type){
        global $db_credentials;
        
        return $db_credentials[$type];
    }
}
?>