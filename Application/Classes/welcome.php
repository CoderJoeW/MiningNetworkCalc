<?php
class Welcome extends Auth{
    public $data = null;
    public $db = null;
    public $template = 'template';
    public $use_template = true;
    public $auth_required = false;

    
    public function Init(){        
        if($this->auth_required){
            $this->AuthRequired();
        }
    }
}

?>