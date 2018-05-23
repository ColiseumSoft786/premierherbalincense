<?php

namespace App\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 */
class Product
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $image;

    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var integer
     */
    private $bs;

    /**
     * @var integer
     */
    private $ws;

    /**
     * @var integer
     */
    private $kartom;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \App\DataBundle\Entity\Sub
     */
    private $sub;


    /**
     * Set name
     *
     * @param string $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Product
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set bs
     *
     * @param integer $bs
     * @return Product
     */
    public function setBs($bs)
    {
        $this->bs = $bs;

        return $this;
    }

    /**
     * Get bs
     *
     * @return integer 
     */
    public function getBs()
    {
        return $this->bs;
    }

    /**
     * Set ws
     *
     * @param integer $ws
     * @return Product
     */
    public function setWs($ws)
    {
        $this->ws = $ws;

        return $this;
    }

    /**
     * Get ws
     *
     * @return integer 
     */
    public function getWs()
    {
        return $this->ws;
    }

    /**
     * Set kartom
     *
     * @param integer $kartom
     * @return Product
     */
    public function setKartom($kartom)
    {
        $this->kartom = $kartom;

        return $this;
    }

    /**
     * Get kartom
     *
     * @return integer 
     */
    public function getKartom()
    {
        return $this->kartom;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sub
     *
     * @param \App\DataBundle\Entity\Sub $sub
     * @return Product
     */
    public function setSub(\App\DataBundle\Entity\Sub $sub = null)
    {
        $this->sub = $sub;

        return $this;
    }

    /**
     * Get sub
     *
     * @return \App\DataBundle\Entity\Sub 
     */
    public function getSub()
    {
        return $this->sub;
    }
    /**
     * @var string
     */
    private $details;


    /**
     * Set details
     *
     * @param string $details
     * @return Product
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details
     *
     * @return string 
     */
    public function getDetails()
    {
        return $this->details;
    }
    /**
     * @var integer
     */
    private $price;


    /**
     * Set price
     *
     * @param integer $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }
}
