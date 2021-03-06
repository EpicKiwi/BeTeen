<?php

namespace BeTeen\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    
    public function findLimit($limit)
    {
        $builder = $this->createQueryBuilder("u");
        
        $builder->orderBy("u.username");
        
        if($limit > 0)
        {
            $builder->setMaxResults($limit);
        }
        
        return $builder->getQuery()->getResult() ;
    }
    
}
