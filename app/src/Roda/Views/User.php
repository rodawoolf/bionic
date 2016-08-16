<?php
/**
 * Created by PhpStorm.
 * User: v.kovalenko
 * Date: 12.07.2016
 * Time: 11:40
 */

namespace Roda\Views;
use Roda\Models\User as UserModel;

class User extends Menu
{
     /**
     * @param $user
     * @param string $template
     */
    public  static function getView($user,string $template = "noedit")
    {
        $view = 'Нет шаблона пользователя';
        
        if ($template == "noedit" || $template == "edit" || $template == "noeditTab"){

            ob_start();
            require(DIR.'/src/Roda/Views/template/'.$template.'User.php');
            $view = ob_get_contents();
            ob_end_clean();
           }

        //print_r($view);
        return $view;
    }
   
   
}