<?php

namespace App\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sub
 */
class Sub
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \App\DataBundle\Entity\Main
     */
    private $main;


    /**
     * Set name
     *
     * @param string $name
     * @return Sub
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set main
     *
     * @param \App\DataBundle\Entity\Main $main
     * @return Sub
     */
    public function setMain(\App\DataBundle\Entity\Main $main = null)
    {
        $this->main = $main;

        return $this;
    }

    /**
     * Get main
     *
     * @return \App\DataBundle\Entity\Main 
     */
    public function getMain()
    {
        return $this->main;
    }
}
