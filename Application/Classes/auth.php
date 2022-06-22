<?php
class Auth{
    public function AuthRequired(){
        if(!$this->IsLoggedIn()){
            header('Location: /index/login/');    
        }
    }
    
    public function IsLoggedIn(){
        if(empty($_SESSION)){
            return false;   
        }else{
            return $_SESSION['LoggedIn'];
        }
    }
}
?>