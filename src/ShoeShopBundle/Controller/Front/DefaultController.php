<?php

namespace ShoeShopBundle\Controller\Front;

use ShoeShopBundle\Entity\Buty;
use ShoeShopBundle\Entity\Rozmiar;
use ShoeShopBundle\Form\ButyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @return array
     * @Route("firewall-test")
     * @Template()
     * @Security("has_role('ROLE_ADMIN')")
     */

    public function firewallTestAction()
    {
        $user = $this->getUser();

        return array();
    }

    /**
     * @Route("/", name="app_front_default_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $shoes = $em->getRepository("ShoeShopBundle:Buty")->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $shoes,
            $request->get('page',1),
            12
        );
        return array(
            'pagination' => $pagination,
        );
}

    /**
     * @param Request $request
     * @Route("/buty/{id}", name="app_front_default_show")
     * @Template()
     */
    public function showAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $buty = $em->getRepository("ShoeShopBundle:Buty")->findOneById($id);

        if(!$buty){
            throw $this->createNotFoundException();
        }

        return array(
            'buty' => $buty
        );
    }
}
