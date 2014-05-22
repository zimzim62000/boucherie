<?php

namespace ZIMZIM\Bundles\OpinionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use ZIMZIM\Controller\ZimzimController;

use ZIMZIM\Bundles\OpinionBundle\Entity\TypeButchery;
use ZIMZIM\Bundles\OpinionBundle\Form\TypeButcheryType;

/**
 * TypeButchery controller.
 *
 */
class TypeButcheryController extends ZimzimController
{

    /**
     * Lists all TypeButchery entities.
     *
     */
    public function indexAction()
    {
        $data = array(
            'entity' => 'ZIMZIMBundlesOpinionBundle:TypeButchery',
            'show' => 'zimzim_opinion_typebutchery_show',
            'edit' => 'zimzim_opinion_typebutchery_edit'
        );

        $this->gridList($data);


        return $this->grid->getGridResponse('ZIMZIMBundlesOpinionBundle:TypeButchery:index.html.twig');
    }

    /**
     * Creates a new TypeButchery entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TypeButchery();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->createSuccess();
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect(
                $this->generateUrl('zimzim_opinion_typebutchery_show', array('id' => $entity->getId()))
            );
        }

        return $this->render(
            'ZIMZIMBundlesOpinionBundle:TypeButchery:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a form to create a TypeButchery entity.
     *
     * @param TypeButchery $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TypeButchery $entity)
    {
        $form = $this->createForm(
            new TypeButcheryType(),
            $entity,
            array(
                'action' => $this->generateUrl('zimzim_opinion_typebutchery_create'),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.create'));

        return $form;
    }

    /**
     * Displays a form to create a new TypeButchery entity.
     *
     */
    public function newAction()
    {
        $entity = new TypeButchery();
        $form = $this->createCreateForm($entity);

        return $this->render(
            'ZIMZIMBundlesOpinionBundle:TypeButchery:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Finds and displays a TypeButchery entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:TypeButchery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeButchery entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMBundlesOpinionBundle:TypeButchery:show.html.twig',
            array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Displays a form to edit an existing TypeButchery entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:TypeButchery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeButchery entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMBundlesOpinionBundle:TypeButchery:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Creates a form to edit a TypeButchery entity.
     *
     * @param TypeButchery $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(TypeButchery $entity)
    {
        $form = $this->createForm(
            new TypeButcheryType(),
            $entity,
            array(
                'action' => $this->generateUrl('zimzim_opinion_typebutchery_update', array('id' => $entity->getId())),
                'method' => 'PUT',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }

    /**
     * Edits an existing TypeButchery entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:TypeButchery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeButchery entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $this->updateSuccess();
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_opinion_typebutchery_edit', array('id' => $id)));
        }

        return $this->render(
            'ZIMZIMBundlesOpinionBundle:TypeButchery:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Deletes a TypeButchery entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:TypeButchery')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TypeButchery entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->deleteSuccess();
        }

        return $this->redirect($this->generateUrl('zimzim_opinion_typebutchery'));
    }

    /**
     * Creates a form to delete a TypeButchery entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zimzim_opinion_typebutchery_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'button.delete'))
            ->getForm();
    }
}
