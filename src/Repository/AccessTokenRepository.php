<?php

namespace App\Repository;

use App\Entity\AccessToken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;

/**
 * @extends ServiceEntityRepository<AccessToken>
 *
 * @method AccessToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccessToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccessToken[]    findAll()
 * @method AccessToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccessTokenRepository extends ServiceEntityRepository implements AccessTokenRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccessToken::class);
    }

    public function save(AccessToken $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AccessToken $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null)
    {
        $obj = new AccessToken();
        $obj->setClient($clientEntity);
//        $obj->setScopes($scopes);
        $obj->setUserIdentifier($userIdentifier);

        return $obj;
    }

    public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity)
    {
        $this->_em->persist($accessTokenEntity);
        $this->_em->flush();
    }

    public function revokeAccessToken($tokenId): void
    {
        $token = $this->findOneBy(['identifier'=>$tokenId]);
        if ($token === null) {
            return;
        }
        $token->setExpiryDateTime(new \DateTime());
        $this->_em->flush();
    }

    public function isAccessTokenRevoked($tokenId): bool
    {
        $token = $this->findOneBy(['identifier'=>$tokenId]);
        if ($token === null) {
            return true;
        }
        return $token->getExpiryDateTime() < new \DateTime();
    }
}
