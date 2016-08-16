<?php
namespace Roda\Controllers;

class MainController
{
    private $helloMessage;

    /**
     * @return mixed
     */
    public function getHelloMessage()
    {
        return $this->helloMessage;
    }

    /**
     * @param mixed $helloMessage
     */
    public function setHelloMessage($helloMessage)
    {
        $this->helloMessage = $helloMessage;
    }
    /**
     * @param string $template
     * @return string
     */
    static function UserInfo()
    {
        if (isset($_SESSION['user'])){
            return $_SESSION['username'];
            
        }
        return 'Гость';
    }

    static function initTemplate(string $template="index.php")
    {
        ob_start();
        require(DIR.'/src/Roda/Template/'.$template);
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
        
    }

    public function testAction(){
        $loader = new \Twig_Loader_Array(array(
            'index' => 'Hello {{ name }}!',
        ));
        $twig = new \Twig_Environment($loader);

        echo $twig->render('index', array('name' => 'Fabien'));
    }

    public function loginAction()
    {
    
        if (isset($_POST['nic']) && isset($_POST['passwd'])){
            if (User::login($_POST['nic'],$_POST['passwd'])) {
                  $this->indexAction();
            }
            else {
               unset($_POST['nic']);
               unset($_POST['passwd']);
               $this->loginAction();
            }
          }
        else {
            $template = self::initTemplate();
            ob_start();
            require(DIR . '/src/Roda/Views/template/loginUser.php');
            $html = ob_get_contents();
            ob_end_clean();
            $index = str_replace("{::body}", $html, $template);
            $index = str_replace("{::menu}", '', $index);
            echo $index;
        }
    }



     /**
     *
     */
    public function indexAction()
    {
        $this -> setHelloMessage('Добро пожаловать на главную');
        $template = self::initTemplate();

        $flGet = $this -> getValByEntityId();

        if (!$flGet){

            $index = str_replace("{::body}", ($this->getHelloMessage()), $template);
            $index = str_replace("{::menu}", '', $index);
            echo $index;
        }
    }

    public function getValByEntityId()
    {
        $status = false;
        if (isset($_GET['entity'])){
            $controllerClass = $_GET['entity'];
            $controllerClass = 'Roda\Controllers\\'.$controllerClass;
            $controllerMethod = 'get'.$_GET['entity'].'Action';
           // var_dump(new $controllerClass); die;
            if (!class_exists($controllerClass) || !method_exists($controllerClass, $controllerMethod)) {
               // throw new RuntimeException('Your Controllers is a shit! '.$controllerClass.' '.$controllerMethod);
            }

            $response = (new $controllerClass)->$controllerMethod();

            $status = true;
        }
        return $status;
    }
   


}
