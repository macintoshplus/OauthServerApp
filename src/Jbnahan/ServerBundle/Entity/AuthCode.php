<?php
// src/Acme/DemoBundle/Entity/AuthCode.php

namespace Acme\DemoBundle\Entity;

use FOS\OAuthServerBundle\Entity\AuthCode as BaseAuthCode;
use Doctrine\ORM\Mapping as ORM;

class AuthCode extends BaseAuthCode
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Jbnahan\ServerBundle\Entity\Client
     */
    protected $client;

    /**
     * @var \Jbnahan\ServerBundle\Entity\User
     */
    protected $user;


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
     * Set client
     *
     * @param \FOS\OAuthServerBundle\Model\ClientInterface $client
     * @return AccessToken
     */
    public function setClient(\FOS\OAuthServerBundle\Model\ClientInterface $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Jbnahan\ServerBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set user
     *
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     * @return AccessToken
     */
    public function setUser(\Symfony\Component\Security\Core\User\UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Jbnahan\ServerBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
