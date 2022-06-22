<?php
session_start();

require_once __DIR__.'/config.php';

if(isset($argv)){
    $options = getopt('',array('uri::'));
    
    $url = explode('/', ltrim($options['uri'],'/'));
}else{
    if($engine == 'nginx'){
        $url = isset($_SERVER['REQUEST_URI']) ? explode('/', ltrim($_SERVER['REQUEST_URI'],'/')) : '/';
    }else if($engine == 'apache'){
        $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')) : '/';
    }
}

if ($url == '/' || empty($url[0])){
    require_once(__DIR__.'/Modules/Home/Controller/home.php');

    $controller = new Home();
    
    $view = $controller->Index();
    
    $controller->Init();
    
    if($controller->data != null){
        extract($controller->data, EXTR_PREFIX_SAME, 'wddx');       
    }
    
    $view_path = __DIR__.'/Modules/Home/View/'.$view.'.php';

    if(file_exists($view_path)){
        require_once(__DIR__.'/Application/View/template.php');
    }
}else{
    //The first element should be a controller
    $requested_controller = ucfirst($url[0]); 

    // If a second part is added in the URI, 
    // it should be a method
    $requested_action = isset($url[1])? ucfirst($url[1]) :'';

    // The remain parts are considered as 
    // arguments of the method
    $requested_params = array_slice($url, 2); 

    // Check if controller exists.
    $ctrl_path = __DIR__.'/Modules/'.$requested_controller.'/Controller/'.strtolower($requested_controller).'.php';

    if (file_exists($ctrl_path)){
        $view = null;
        
        require_once($ctrl_path);

        $controller_name = $requested_controller;

        $controller_obj  = new $controller_name();
        
        if($requested_action != ''){
            $view = $controller_obj->$requested_action($requested_params);
        }else{
            // If no action is specified we default to loading the index
            $view = $controller_obj->Index($requested_params);
        }
        
        $controller_obj->Init();
        
        if($controller_obj->data != null){
            extract($controller_obj->data, EXTR_PREFIX_SAME, 'wddx');   
        }
        
        if($view != null){
            // Store view path
            $view_path = __DIR__.'/Modules/'.$requested_controller.'/View/'.$view.'.php';

            // Check if view uses template
            if($controller_obj->use_template){

                if(file_exists($view_path)){
                    require_once(__DIR__.'/Application/View/'.$controller_obj->template.'.php');
                }
            }else{
                // If the view does not use the template then we just load the view
                if(file_exists($view_path)){
                    require_once($view_path);
                }
            }
        }
    }else{
        header('HTTP/1.1 404 Not Found');
        
        require_once(__DIR__.'/Application/View/404.php');
    }
}
