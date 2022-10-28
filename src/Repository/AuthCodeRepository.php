<?php

namespace App\Repository;

use App\Entity\AuthCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;

/**
 * @extends ServiceEntityRepository<AuthCode>
 *
 * @method AuthCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method AuthCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method AuthCode[]    findAll()
 * @method AuthCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthCodeRepository extends ServiceEntityRepository implements AuthCodeRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuthCode::class);
    }

    public function save(AuthCode $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AuthCode $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getNewAuthCode()
    {
        return new AuthCode();
    }

    public function persistNewAuthCode(AuthCodeEntityInterface $authCodeEntity)
    {
        $this->_em->persist($authCodeEntity);
        $this->_em->flush();
    }

    public function revokeAuthCode($codeId)
    {

        $token = $this->findOneBy(['identifier'=>$codeId]);
        if ($token === null) {
            return;
        }
        $token->setExpiryDateTime(new \DateTime());
        $this->_em->flush();
    }

    public function isAuthCodeRevoked($codeId)
    {

        $token = $this->findOneBy(['identifier'=>$codeId]);
        if ($token === null) {
            return true;
        }

        return $token->getExpiryDateTime() < new \DateTime();
    }
}
