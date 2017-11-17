<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Oferta;
use AppBundle\Form\OfertaAjaxType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Banner;
use AppBundle\Form\BannerType;

/**
 * Banner controller.
 *
 * @Route("/banner")
 */
class BannerController extends Controller
{

    /**
     * Displays a form to edit an existing Banner entity.
     *
     * @Route("/{id}/edit", name="banner_edit")
     * @Method("GET")
     * @Template("AppBundle:Oferta:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Oferta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Oferta entity.');
        }

        $editForm = $this->createOfertaEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    private function createOfertaEditForm(Oferta $entity)
    {
        $form = $this->createForm(new OfertaAjaxType(), $entity, array(
            'action' => $this->generateUrl('banner_edit', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
}
