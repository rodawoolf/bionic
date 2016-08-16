<?php
/**
 * Created by PhpStorm.
 * User: v.kovalenko
 * Date: 11.07.2016
 * Time: 16:01
 */

namespace Roda\Controllers;
use Roda\Models\Repository\Comment as CommentRepository;
use Roda\Views\Comment as CommentView;

class Comment extends MainController
{
    /**
     * @return bool
     */
    public function indexAction()
    {
        $template = self::initTemplate();
        $index = str_replace("{::body}",'Вы на страничке комментариев',$template);
        $index = str_replace("{::menu}",CommentView::getMenu('comment'),$index);
        echo $index;
        return true;
    }

    /**
     * @return bool
     * @throws \Exception
     */

    public function getCommentAction()
    {
        if (!$id = $_GET['id'] ?: false) {
            $id = 0;
        }
        $Comment = new CommentRepository();
        $CommentEntity = $Comment->getOneById($id);
        $CommentView = CommentView::getView($CommentEntity);

        $template = self::initTemplate();
        $index = str_replace("{::body}",$CommentView,$template);
        $index = str_replace("{::menu}",CommentView::getMenu('comment'),$index);
        echo $index;
        return true;
        
    }

    public function getAction()
    {
        $view = '';
        $Comment = new CommentRepository();
        $Comments = $Comment->getAll();
        foreach ($Comments as $key=>$val){
            $CommentView = CommentView::getView($val);
            $view=$view.'<br>'.$CommentView;
        }

        $template = self::initTemplate();
        $index = str_replace("{::body}",$view,$template);
        $index = str_replace("{::menu}",CommentView::getMenu('comment'),$index);
        echo $index;
        return true;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function addCommentAction()
    {


        $comentRepository = new CommentRepository();

        if(isset($_POST['confirm'])){
            $id = $comentRepository->addOne($_POST)->getId();
            $_POST['comentId'] = $id;

            unset($_POST['confirm']);

        }

        if(isset($_POST['edit'])){
            $id = $comentRepository->editOne($_POST)->getId();
            unset($_POST['edit']);

        }
        if(isset($_GET['id']) && !isset($_POST['comentId'])) {
            $_POST['comentId'] = $_GET['id'];
        }


        $CommentView = CommentView::getView($comentRepository->getOneById($_POST['comentId']),"edit");

        $template = self::initTemplate();
        $index = str_replace("{::body}",$CommentView,$template);
        $index = str_replace("{::menu}",CommentView::getMenu('adv'),$index);
        echo $index;
        return true;
    }
}
