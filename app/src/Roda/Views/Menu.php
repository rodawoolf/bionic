<?php
/**
 * Created by PhpStorm.
 * User: v.kovalenko
 * Date: 18.07.2016
 * Time: 13:20
 */

namespace Roda\Views;


class Menu
{
    
    public  static function getMenu(string $template)
    {
        $view = 'Нет шаблона меню '.$template;

        if ($template == "user" || $template == "adv" || $template == "comment"){
            ob_start();
            require(DIR.'/src/Roda/Views/template/'.$template.'Menu.php');
            $view = ob_get_contents();
            ob_end_clean();
        }

        return $view;
    }
}