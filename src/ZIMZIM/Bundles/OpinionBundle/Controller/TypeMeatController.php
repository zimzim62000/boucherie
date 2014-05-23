<?php

namespace ZIMZIM\Bundles\OpinionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use ZIMZIM\Controller\ZimzimController;

use ZIMZIM\Bundles\OpinionBundle\Entity\TypeMeat;
use ZIMZIM\Bundles\OpinionBundle\Form\TypeMeatType;

/**
 * TypeMeat controller.
 *
 */
class TypeMeatController extends ZimzimController
{

    /**
     * Lists all TypeMeat entities.
     *
     */
    public function indexAction()
    {
    $data = array(
        'entity'     => 'ZIMZIMBundlesOpinionBundle:TypeMeat',
        'show'       => 'zimzim_opinion_typemeat_show',
        'edit'       => 'zimzim_opinion_typemeat_edit'
    );

    $this->gridList($data);


   return $this->grid->getGridResponse('ZIMZIMBundlesOpinionBundle:TypeMeat:index.html.twig');
    }
    /**
     * Creates a new TypeMeat entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TypeMeat();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->createSuccess();
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_opinion_typemeat_show', array('id' => $entity->getId())));
        }

        return $this->render('ZIMZIMBundlesOpinionBundle:TypeMeat:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a TypeMeat entity.
    *
    * @param TypeMeat $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(TypeMeat $entity)
    {
        $form = $this->createForm(new TypeMeatType(), $entity, array(
            'action' => $this->generateUrl('zimzim_opinion_typemeat_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'button.create'));

        return $form;
    }

    /**
     * Displays a form to create a new TypeMeat entity.
     *
     */
    public function newAction()
    {
        $entity = new TypeMeat();
        $form   = $this->createCreateForm($entity);

        return $this->render('ZIMZIMBundlesOpinionBundle:TypeMeat:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TypeMeat entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:TypeMeat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeMeat entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZIMZIMBundlesOpinionBundle:TypeMeat:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing TypeMeat entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:TypeMeat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeMeat entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZIMZIMBundlesOpinionBundle:TypeMeat:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TypeMeat entity.
    *
    * @param TypeMeat $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TypeMeat $entity)
    {
        $form = $this->createForm(new TypeMeatType(), $entity, array(
            'action' => $this->generateUrl('zimzim_opinion_typemeat_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }
    /**
     * Edits an existing TypeMeat entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:TypeMeat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeMeat entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
			$this->updateSuccess();
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_opinion_typemeat_edit', array('id' => $id)));
        }

        return $this->render('ZIMZIMBundlesOpinionBundle:TypeMeat:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TypeMeat entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:TypeMeat')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TypeMeat entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->deleteSuccess();
        }

        return $this->redirect($this->generateUrl('zimzim_opinion_typemeat'));
    }

    /**
     * Creates a form to delete a TypeMeat entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zimzim_opinion_typemeat_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'button.delete'))
            ->getForm()
        ;
    }
}
