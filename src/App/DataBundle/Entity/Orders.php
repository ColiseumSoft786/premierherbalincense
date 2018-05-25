<?php

namespace App\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 */
class Orders
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
     * @var string
     */
    private $payment;

    /**
     * @var string
     */
    private $card;

    /**
     * @var string
     */
    private $cvv;

    /**
     * @var string
     */
    private $exp;

    /**
     * @var integer
     */
    private $price;

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
     * @return Orders
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
     * @return Orders
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
     * Set payment
     *
     * @param string $payment
     * @return Orders
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment
     *
     * @return string 
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set card
     *
     * @param string $card
     * @return Orders
     */
    public function setCard($card)
    {
        $this->card = $card;

        return $this;
    }

    /**
     * Get card
     *
     * @return string 
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * Set cvv
     *
     * @param string $cvv
     * @return Orders
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;

        return $this;
    }

    /**
     * Get cvv
     *
     * @return string 
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * Set exp
     *
     * @param string $exp
     * @return Orders
     */
    public function setExp($exp)
    {
        $this->exp = $exp;

        return $this;
    }

    /**
     * Get exp
     *
     * @return string 
     */
    public function getExp()
    {
        return $this->exp;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Orders
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
     * @return Orders
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
    /**
     * @var string
     */
    private $review;


    /**
     * Set review
     *
     * @param string $review
     * @return Orders
     */
    public function setReview($review)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Get review
     *
     * @return string 
     */
    public function getReview()
    {
        return $this->review;
    }
}
