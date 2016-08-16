<?php
/**
 * Created by PhpStorm.
 * User: v.kovalenko
 * Date: 12.07.2016
 * Time: 11:40
 */

namespace Roda\Views;
use Roda\Models\Comment as CommentModel;

class Comment extends Menu
{
    public  static function getView(CommentModel $comment,string $template = "noedit")
    {
        $view = 'Нет шаблона пользователя';

        if ($template == "noedit" || $template == "edit" ){
            ob_start();
            require(DIR.'/src/Roda/Views/template/'.$template.'Comment.php');
            $view = ob_get_contents();
            ob_end_clean();
        }

        return $view;
    }
}