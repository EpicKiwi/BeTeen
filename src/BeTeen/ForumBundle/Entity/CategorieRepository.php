<?php

namespace BeTeen\ForumBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * CategorieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategorieRepository extends NestedTreeRepository
{
    public function findOneBySlugSujetOrder($slug)
    {
        $builder = $this->createQueryBuilder("c");
        $builder->leftJoin("c.sujetsStandards","s")
                ->addSelect("s")->where("c.slug = :slug")
                ->setParameter("slug", $slug)
                ->orderBy("s.date","DESC");
        
        return $builder->getQuery()->getOneOrNullResult();
    }
}
