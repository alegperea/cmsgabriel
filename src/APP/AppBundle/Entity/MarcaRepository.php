<?php

namespace APP\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MarcaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MarcaRepository extends EntityRepository {
/*
    public function findProyectos($parameters) {
        $qb = $this->createQueryBuilder('l');
        if ($parameters->get('simple_search')) {
            $fullName = $parameters->get('simple_search');
            $qb->where($qb->expr()->andX(
                            $qb->expr()->like('l.nombre', $qb->expr()->literal('%' . $fullName . '%'))
            ));
        }
        return $qb->getQuery()->getResult();
    }
*/
    public function findMarca($busqueda = null) {
        $qb = $this->createQueryBuilder('p');       
        if ($busqueda) {
            $qb->andWhere($qb->expr()->andX(
                            $qb->expr()->like('p.nombre', $qb->expr()->literal('%' . $busqueda . '%'))
            ));
        }
        return $qb->getQuery()->getResult();
    }

}
