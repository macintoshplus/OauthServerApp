<?php
namespace Jbnahan\ServerBundle\Entity;

use FOS\OAuthServerBundle\Entity\Client as BaseClient;
use Doctrine\ORM\Mapping as ORM;

class Client extends BaseClient
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @return string
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @param string $name
     * @return Client
     */
    public function setName($name){
        $this->name = $name;

        return $this;
    }

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();
    }
}