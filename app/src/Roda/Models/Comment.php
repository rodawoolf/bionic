<?php

namespace Roda\Models;




class Comment  
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $user_id;

    /**
     * @var int
     */
    private $adv_id;

    /**
     * @var string
     */
    private $text;

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
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getAdvId()
    {
        return $this->adv_id;
    }

    /**
     * @param int $adv_id
     */
    public function setAdvId($adv_id)
    {
        $this->adv_id = $adv_id;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Comment constructor.
     * @param array $atr
     */
    public function __construct(array $atr = [])
    {
        foreach ($atr as $key => $value){
            if (property_exists($this,$key)){
                $this->{$key} = $value;
            }
        }
    }
}
