<?php

namespace ShoeShopBundle\Controller\Admin;

use ShoeShopBundle\Entity\Rozmiar;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ShoeShopBundle\Entity\Buty;
use ShoeShopBundle\Form\ButyType;
use Doctrine\Common\Persistence\EntityManager;
/**
 * Buty controller.
 *
 * @Route("/buty")
 */
class ButyController extends Controller
{
    /**
     * Lists all Buty entities.
     *
     * @Route("/", name="app_admin_buty_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $shoes = $em->getRepository('ShoeShopBundle:Buty')->findAll();

        return $this->render('ShoeShopBundle:Admin/Buty:index.html.twig', array(
            'shoes' => $shoes,
        ));
    }

    /**
     * Creates a new Buty entity.
     *
     * @Route("/new", name="app_admin_buty_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $buty = new Buty();
        $form = $this->createForm('ShoeShopBundle\Form\ButyType', $buty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $buty->getZdjecie();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('img_directory'),
                $fileName
            );
            $buty->setZdjecie($fileName);

            $ext_pos = strrpos($fileName, '.');

            $file2 = $buty->getZdjecieMIN();
            $fileName2 = substr($fileName, 0, $ext_pos) . '_min' . substr($fileName, $ext_pos);;
            $file2->move(
                $this->getParameter('img_directory'),
                $fileName2
            );
            $buty->setZdjecieMIN($fileName2);

            $em = $this->getDoctrine()->getManager();
            $em->persist($buty);
            $em->flush();

            return $this->redirectToRoute('app_admin_buty_show', array('id' => $buty->getId()));
        }

        return $this->render('ShoeShopBundle:Admin/Buty:new.html.twig', array(
            'buty' => $buty,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Buty entity.
     *
     * @Route("/{id}", name="app_admin_buty_show")
     * @Method("GET")
     */
    public function showAction(Buty $buty)
    {
        $deleteForm = $this->createDeleteForm($buty);

        return $this->render('ShoeShopBundle:Admin/Buty:show.html.twig', array(
            'buty' => $buty,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Buty entity.
     *
     * @Route("/{id}/edit", name="app_admin_buty_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Buty $buty)
    {
        /*$manager = $this->getDoctrine()->getManager();*/
        $deleteForm = $this->createDeleteForm($buty);
        $editForm = $this->createForm('ShoeShopBundle\Form\ButyType', $buty);
        /*$editForm = $this->createForm(new ButyType($manager), $buty);*/
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($buty);
            $em->flush();

            return $this->redirectToRoute('app_admin_buty_edit', array('id' => $buty->getId()));
        }

        return $this->render('ShoeShopBundle:Admin/Buty:edit.html.twig', array(
            'buty' => $buty,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Buty entity.
     *
     * @Route("/{id}", name="app_admin_buty_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Buty $buty)
    {
        $form = $this->createDeleteForm($buty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($buty);
            $em->flush();
        }

        return $this->redirectToRoute('app_admin_buty_index');
    }

    /**
     * Creates a form to delete a Buty entity.
     *
     * @param Buty $buty The Buty entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Buty $buty)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('app_admin_buty_delete', array('id' => $buty->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
