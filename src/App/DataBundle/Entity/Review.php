<?php

namespace App\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Review
 */
class Review
{
    /**
     * @var integer
     */
    private $star;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \App\DataBundle\Entity\Product
     */
    private $product;


    /**
     * Set star
     *
     * @param integer $star
     * @return Review
     */
    public function setStar($star)
    {
        $this->star = $star;

        return $this;
    }

    /**
     * Get star
     *
     * @return integer 
     */
    public function getStar()
    {
        return $this->star;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Review
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
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
     * Set product
     *
     * @param \App\DataBundle\Entity\Product $product
     * @return Review
     */
    public function setProduct(\App\DataBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \App\DataBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
