<?php
/**
 * Created by PhpStorm.
 * User: v.kovalenko
 * Date: 11.07.2016
 * Time: 16:01
 */

namespace Roda\Controllers;
use Roda\Models\Repository\User as UserRepository;
use Roda\Views\User as UserView;


class User extends MainController
{
    /**
     * @return bool
     */
    static function login($nic,$passwd)
    {
        $res=false;
        $where = [
            'nic' => '"'.$nic.'"',
        ];

        $users = \Roda\Models\Repository\User::get($where);
        /*
        echo '<pre>';
        print_r(md5(''));
        echo '</pre>';
        */
        foreach ($users as $user){
            if ($user->getPasswd() == md5(($passwd).($user->getSurname()))){
                $_SESSION['user'] = $user;
                $_SESSION['username'] = $user->getNic();
                $res=true;
                break;
            }
        }
        return $res;
    }

    static function logout()
    {
            unset($_SESSION['user']);
            $_SESSION['username'] = 'Гость';
    }

    /**
     * @return bool
     */
    public function indexAction()
    {
        $this -> setHelloMessage('Вы на страничке пользователей');
        $template = self::initTemplate();
        $index = str_replace("{::body}",$this -> getHelloMessage(),$template);
        $index = str_replace("{::menu}",UserView::getMenu('user'),$index);
        echo $index;
        return true;
    }

    /**
     * @return bool
     * @throws \Exception
     */

    public function getUserAction()
    {
        if (!$id = $_GET['id'] ?: false) {
            $id = 0;
        }
        $userRepository = new UserRepository();
        $userEntity = $userRepository->getOneById($id);
        $UserView = UserView::getView($userEntity);
        $template = self::initTemplate();

        $index = str_replace("{::body}",$UserView,$template);
        $index = str_replace("{::menu}",UserView::getMenu('user'),$index);;
        echo $index;
        return true;
        
    }

    public function getAction()
    {
        $view = '';
        $userRepository = new UserRepository();
        $users = $userRepository->getAll();
        
        //array 




        $view = UserView::getView($users,"noeditTab");
 /*
        foreach ($users as $key=>$val){
            $UserView = UserView::getView($val);
            $view = $view.'<br>'.$UserView;
        }
*/

        $template = self::initTemplate();
        $index = str_replace("{::body}",$view,$template);
        $index = str_replace("{::menu}",UserView::getMenu('user'),$index);
        echo $index;
        return true;
    }
    
    public function addUserAction()
    {

        
       $userRepository = new UserRepository();

       if(isset($_POST['confirm'])){
           $id = $userRepository->addOne($_POST)->getId();
           $_POST['userId'] = $id;

           unset($_POST['confirm']);
          
       }

       if(isset($_POST['edit'])){
           $id = $userRepository->editOne($_POST)->getId();
           unset($_POST['edit']);
          
       }
        if(isset($_GET['id']) && !isset($_POST['userId'])) {
            $_POST['userId'] = $_GET['id'];
            }
       
/*
        echo '<pre>';
        echo '<br>';
        print_r($_GET);
        echo '</pre>';
*/
        $userId = NULL;

        if(isset($_POST['userId'])) {
            $userId = $_POST['userId'];
        }
        $UserView = UserView::getView($userRepository->getOneById($userId), "edit");
        $template = self::initTemplate();
        $index = str_replace("{::body}",$UserView,$template);
        $index = str_replace("{::menu}",UserView::getMenu('user'),$index);
        echo $index;
        return true;
    }
   
}
