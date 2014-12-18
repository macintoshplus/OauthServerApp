<?php
// src/Acme/DemoBundle/Entity/RefreshToken.php

namespace Acme\DemoBundle\Entity;

use FOS\OAuthServerBundle\Entity\RefreshToken as BaseRefreshToken;
use Doctrine\ORM\Mapping as ORM;

class RefreshToken extends BaseRefreshToken
{}