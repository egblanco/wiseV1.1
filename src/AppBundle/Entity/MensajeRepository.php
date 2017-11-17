<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * OfertaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MensajeRepository extends EntityRepository
{
    public function getComentariosAprobadosQuery($locale)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT m FROM AppBundle:Mensaje m '.
            'JOIN m.tipo t '.
            'JOIN m.estado e '.
            'WHERE t.id = 2 ' .
            'AND e.id = 2 '.
            'AND m.locale = :locale ' .
            'ORDER BY m.creado DESC'
        )->setParameter('locale', $locale);
        return $query;
    }
}