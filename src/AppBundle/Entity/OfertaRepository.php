<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * OfertaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OfertaRepository extends EntityRepository
{
    public function getOfertaAutos($id)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT o,tr, t, oa, a FROM AppBundle:Oferta o ' .
            'JOIN o.translations tr '.
            'JOIN o.tipo t ' .
            'LEFT JOIN o.ofertaAutos oa ' .
            'LEFT JOIN oa.auto a ' .
            'WHERE t.id = :id '.
            'AND o.activa = 1 '
        )->setParameter('id', $id);
        $result = $query->getResult();
        return $result;
    }

    public function getOfertas($id)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT ofe,ofetip,ofeAuto,aut FROM AppBundle:OfertaTipo ofetip ' .
            'JOIN ofetip.ofertas ofe ' .
            'JOIN ofe.ofertaAutos ofeAuto ' .
            'JOIN ofeAuto.auto aut ' .
            'WHERE ofetip.id = :id '
        )->setParameter('id', $id);
        $result = $query->getResult();
//        $result = $query->getArrayResult();
        return $result;
    }

    public function getOfertaAndOfertaAuto($id)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT o,tr, oa FROM AppBundle:Oferta o ' .
            'JOIN o.translations tr '.
            'JOIN o.ofertaAutos oa ' .
            'WHERE o.id = :id '.
            'AND o.activa = 1 '
        )->setParameter('id', $id);
        $result = $query->getSingleResult();
        return $result;
    }

    public function getOfertasByType($id)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT ofe,ofetip,ofeAuto,aut FROM AppBundle:OfertaAuto ofeAuto ' .
            'JOIN ofeAuto.auto aut ' .
            'JOIN ofeAuto.oferta ofe ' .
            'JOIN ofe.tipo ofetip ' .
            'WHERE ofetip.id = :id '.
            'ORDER BY ofeAuto.semanal'
        )->setParameter('id', $id);
        $result = $query->getResult();
        return $result;
    }

    public function getOfertaByCode($code)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT o,tr, t, oa, a FROM AppBundle:Oferta o ' .
            'JOIN o.translations tr '.
            'JOIN o.tipo t ' .
            'JOIN o.ofertaAutos oa ' .
            'JOIN oa.auto a ' .
            'WHERE o.codigo = :code '
        )->setParameter('code', $code);
        $result = $query->getSingleResult();
        return $result;
    }

    public function getOfertaActivaByCodeAndAuto($code,$id)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT o, oa, a FROM AppBundle:Oferta o ' .
            'JOIN o.ofertaAutos oa ' .
            'JOIN oa.auto a ' .
            'WHERE o.codigo = :code ' .
            'AND a.id = :id ' .
            'AND o.activa = 1 '
        )->setParameter('code', $code)
        ->setParameter('id', $id);
        $result = $query->getOneOrNullResult();
        return $result;
    }

    public function getOfertaByTipo($tipo)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT o,tr, t FROM AppBundle:Oferta o ' .
            'JOIN o.translations tr '.
            'JOIN o.tipo t '.
            'WHERE t.id = :tipo '
        )->setParameter('tipo', $tipo);
        $result = $query->getResult();
        return $result;
    }

}