<?php

namespace App\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Order
 */
class Order
{
    /**
     * @var string
     */
    private $orderid;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \App\DataBundle\Entity\Customer
     */
    private $customer;


    /**
     * Set orderid
     *
     * @param string $orderid
     * @return Order
     */
    public function setOrderid($orderid)
    {
        $this->orderid = $orderid;

        return $this;
    }

    /**
     * Get orderid
     *
     * @return string 
     */
    public function getOrderid()
    {
        return $this->orderid;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Order
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
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
     * Set customer
     *
     * @param \App\DataBundle\Entity\Customer $customer
     * @return Order
     */
    public function setCustomer(\App\DataBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \App\DataBundle\Entity\Customer 
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}
