<?php
/**
 * Created by PhpStorm.
 * User: v.kovalenko
 * Date: 11.07.2016
 * Time: 16:01
 */

namespace Roda\Controllers;
use Roda\Models\Repository\Adv as AdvRepository;
use Roda\Views\Adv as AdvView;
use Roda\Services;

class Adv extends MainController
{
    /**
     * @return bool
     */
    public function indexAction()
    {
        $template = self::initTemplate();
        $index = str_replace("{::body}",'Вы на страничке объявлений',$template);
        $index = str_replace("{::menu}",AdvView::getMenu('adv'),$index);
        echo $index;
        return true;
    }

    /**
     * @return bool
     * @throws \Exception
     */

    public function getAdvAction()
    {
        if (!$id = $_GET['id'] ?: false) {
            $id = 0;
        }
        $adv = new AdvRepository();
        $advEntity = $adv->getOneById($id);
        $advView = AdvView::getView($advEntity);

        $template = self::initTemplate();
        $index = str_replace("{::body}",$advView,$template);
        $index = str_replace("{::menu}",AdvView::getMenu('adv'),$index);
        echo $index;
        return true;
        
    }

    /**
     * @return bool
     */
    public function getAction()
    {
        $view = '';
        $adv = new AdvRepository();
        $advs = $adv->getAll();
        
        
        foreach ($advs as $key=>$val){
            $AdvView = AdvView::getView($val);
            $view=$view.'<br>'.$AdvView;
        }

        $template = self::initTemplate();
        $index = str_replace("{::body}",$view,$template);
        $index = str_replace("{::menu}",AdvView::getMenu('adv'),$index);
        echo $index;
        return true;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function addAdvAction()
    {
     

        if(isset($_POST['confirm'])){
            $_POST['img_id'] = Services\Img::addImg();
            $id = \Roda\Models\Repository\Adv::addOne($_POST)->getId();
            $_POST['advId'] = $id;
            unset($_POST['confirm']);
        }

        if(isset($_POST['edit'])){
            $id = \Roda\Models\Repository\Adv::editOne($_POST)->getId();
            unset($_POST['edit']);

        }
        if(isset($_GET['id']) && !isset($_POST['advId'])) {
            $_POST['advId'] = $_GET['id'];
        }

        $AdvView = AdvView::getView(\Roda\Models\Repository\Adv::getOneById($_POST['advId']),"edit");

        $template = self::initTemplate();
        $index = str_replace("{::body}",$AdvView,$template);
        $index = str_replace("{::menu}",AdvView::getMenu('adv'),$index);
        echo $index;
        return true;
    }
}
