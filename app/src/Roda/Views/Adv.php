<?php
/**
 * Created by PhpStorm.
 * User: v.kovalenko
 * Date: 12.07.2016
 * Time: 11:40
 */

namespace Roda\Views;
use Roda\Models\Adv as AdvModel;

class Adv extends Menu
{
    public  static function getView(AdvModel $adv,string $template = "noedit")
    {
        $view = 'Нет шаблона пользователя';

        if ($template == "noedit" || $template == "edit" ){
            ob_start();
            require(DIR.'/src/Roda/Views/template/'.$template.'Adv.php');
            $view = ob_get_contents();
            ob_end_clean();
        }
        /*
        echo '<pre>';
        print_r(DIR.'/src/Roda/Views/template/'.$template.'Adv.php');
        echo '</pre>';
        die;
        */
        return $view;

    }
}