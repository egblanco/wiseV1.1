<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * AlquilerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AccesorioRepository extends EntityRepository {

    public function getIdIn($ids) {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
                        'SELECT acc FROM AppBundle:Accesorio acc ' .
                        'WHERE acc.id in (:ids) '
                )->setParameter('ids', $ids);
        $result = $query->getResult();
        return $result;
    }
    
}
