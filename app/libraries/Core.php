<?php  

//url management

class Core{

    protected $controller = 'users';     //default controller
    protected $method = 'index';        // deault method
    protected $params = [];             //default params

    public function __construct()
    {
        session_start();
        $url = $this->getUrl();
      
        //if the controller exits in controllers foldeer
        if(isset($url[0]) && file_exists('../app/controllers/'.$url[0].'.php')){
            $this->controller = $url[0];
            unset($url[0]);
            
        }

        require_once '../app/controllers/'.$this->controller.'.php';
        
        $this->controller = new $this->controller;    //make an instance of the relevent object
        
        //if the method exists
        if(isset($url[1])){
            if(method_exists($this->controller,$url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
            
        }

        $this->params = $url ? array_values($url): [];   //final array of params
       
        call_user_func_array([$this->controller,$this->method],$this->params);  //call the significant controller function
    }

    //function to split url
    public function getUrl(){

        if(isset($_GET['url'])){
            return $url = explode('/',filter_var(rtrim($_GET['url'],'/'),FILTER_SANITIZE_URL));
        }

    }




}