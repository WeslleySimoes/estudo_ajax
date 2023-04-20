<?php 

namespace app\core;

class Rota
{
    const NAMESPEACE_CONTROLLER = 'app\\controller\\';
    private $controller;
    private $metodo;

    public function __construct()
    {
        $this->controller = filter_input(INPUT_GET,'c',FILTER_SANITIZE_SPECIAL_CHARS) ?? 'Main';
        $this->metodo     = filter_input(INPUT_GET,'m',FILTER_SANITIZE_SPECIAL_CHARS) ?? 'index';
    }

    public function executar()
    {
        $classeController = self::NAMESPEACE_CONTROLLER.(ucfirst($this->controller));
        
        if(class_exists($classeController))
        {
            $c = new $classeController;

            if(method_exists($c,$this->metodo))
            {
                call_user_func_array([$c,$this->metodo],[]);
                exit();
            }
        }

        http_response_code(404);
    }   
}