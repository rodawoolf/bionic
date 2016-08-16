<?php
namespace Roda\Services;
use Roda\Models\Repository\AbstractRepository;
use Symfony\Component\Ldap\Adapter\AbstractQuery;

class Img extends AbstractRepository
{
    public static function addImg()
    {
    $imgId = 0;
    if($_FILES['userfile']['error'][0] == 0) {
        $file = $_FILES['userfile']['tmp_name'][0];
        $fullName = $_SERVER['DOCUMENT_ROOT'].'/app/Storage/'.time().$_FILES['userfile']['name'][0];
        if (!copy($file, $fullName)) {
            echo "не удалось скопировать $file...\n";
        }

        $conn = self::getConnection();
        $imgData['name'] = $_FILES['userfile']['name'][0];
        $imgData['type'] = $_FILES['userfile']['type'][0];
        $imgData['size'] = $_FILES['userfile']['size'][0];
        $imgData['fullName'] = $fullName;
        $conn->insert('img', $imgData);
        $imgId = $conn->lastInsertId();

    }
    return $imgId;
    }

    public static function imgAction()
    {

        if(isset($_GET['id'])){
            $img = self::getImg($_GET['id']);
            if (file_exists($img['fullName'])) {
                header('Content-Description: File Transfer');
                header('Content-Type: '.$img['type']);
                header('Content-Disposition: attachment; filename="'.$img['name'].'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . $img['size']);
                readfile($img['fullName']);
                exit;
            }
        }
        else{
            throw new \Exception("A file with id = ".$id." is not found");
        }

    }


    public static function getImg($id)
    {
        $img['id'] = '';
        $img['name'] = '';
        $img['fullName'] = '';
        $img['size'] = '';
        $img['type'] = '';

        $conn = self::getConnection();
        $stm = $conn->query("SELECT * FROM img WHERE id = " . $id . " LIMIT 1;");
        $imgs = $stm->fetchAll();

        if (count($imgs) == 0) {
            throw new \Exception("A img with id = ".$id." is not found");
        }
       else {
           $img = $imgs[0];
       }

        return $img;
    }
}
