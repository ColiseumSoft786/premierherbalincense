<?php

namespace App\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pio
 */
class Pio
{
    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \App\DataBundle\Entity\Orders
     */
    private $orders;

    /**
     * @var \App\DataBundle\Entity\Product
     */
    private $product;


    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return Pio
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set orders
     *
     * @param \App\DataBundle\Entity\Orders $orders
     * @return Pio
     */
    public function setOrders(\App\DataBundle\Entity\Orders $orders = null)
    {
        $this->orders = $orders;

        return $this;
    }

    /**
     * Get orders
     *
     * @return \App\DataBundle\Entity\Orders 
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * Set product
     *
     * @param \App\DataBundle\Entity\Product $product
     * @return Pio
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
