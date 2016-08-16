<?php
/**
 * Created by PhpStorm.
 * User: v.kovalenko
 * Date: 12.07.2016
 * Time: 8:48
 */

namespace Roda\Models;


class Adv  
{
    /**
     * Adv constructor.
     * @param array $atr
     */

    public function __construct(array $atr=[])
    {
        foreach ($atr as $key => $value){
            if (property_exists($this,$key)){
                $this->{$key} = $value;
            }
        }
    }
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $img_id;
    
    /**
     * @var int
     */
    private $user_id;

    /**
     * @var string
     */
    private $ImgName;

    /**
     * @return mixed
     */
    public function getImgName()
    {
        return $this->ImgName;
    }

    /**
     * @param mixed $ImgName
     */
    public function setImgName($ImgName)
    {
        $this->ImgName = $ImgName;
    }

    private $title;

    /**
     * @content string
     */
    private $content;

    /**
     * @price float
     */
    private $price;

    /**
     * @return int
     */
    public function getImgId()
    {
        return $this->img_id;
    }

    /**
     * @param int $img_id
     */
    public function setImgId($img_id)
    {
        $this->img_id = $img_id;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }


    
}