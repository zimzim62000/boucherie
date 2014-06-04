<?php

namespace ZIMZIM\Bundles\OpinionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use ZIMZIM\Controller\ZimzimController;

use ZIMZIM\Bundles\OpinionBundle\Entity\Opinion;
use ZIMZIM\Bundles\OpinionBundle\Form\OpinionType;

/**
 * Opinion controller.
 *
 */
class OpinionController extends ZimzimController
{

    /**
     * Lists all Opinion entities.
     *
     */
    public function indexAction()
    {
        $data = array(
            'entity' => 'ZIMZIMBundlesOpinionBundle:Opinion',
            'show' => 'zimzim_opinion_opinion_show',
            'edit' => 'zimzim_opinion_opinion_edit'
        );

        $this->gridList($data);

        $source = $this->grid->getSource();

        $source->manipulateRow(
            function ($row) {
                if ($row->getEntity()->getUser() !== null) {
                    $row->setField('username', $row->getEntity()->getUser()->getFullName());
                }

                return $row;
            }
        );

        return $this->grid->getGridResponse('ZIMZIMBundlesOpinionBundle:Opinion:index.html.twig');
    }

    /**
     * Creates a new Opinion entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Opinion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->createSuccess();
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_opinion_opinion_show', array('id' => $entity->getId())));
        }

        return $this->render(
            'ZIMZIMBundlesOpinionBundle:Opinion:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }


    /**
     * Displays a form to create a new Opinion entity.
     *
     */
    public function newAction()
    {
        $entity = new Opinion();
        $form = $this->createCreateForm($entity);

        return $this->render(
            'ZIMZIMBundlesOpinionBundle:Opinion:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Finds and displays a Opinion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:Opinion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Opinion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMBundlesOpinionBundle:Opinion:show.html.twig',
            array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Displays a form to edit an existing Opinion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:Opinion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Opinion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMBundlesOpinionBundle:Opinion:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Creates a form to edit a Opinion entity.
     *
     * @param Opinion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Opinion $entity)
    {
        $form = $this->createForm(
            new OpinionType(),
            $entity,
            array(
                'action' => $this->generateUrl('zimzim_opinion_opinion_update', array('id' => $entity->getId())),
                'method' => 'PUT',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }

    /**
     * Edits an existing Opinion entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:Opinion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Opinion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $this->updateSuccess();
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_opinion_opinion_edit', array('id' => $id)));
        }

        return $this->render(
            'ZIMZIMBundlesOpinionBundle:Opinion:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Deletes a Opinion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:Opinion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Opinion entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->deleteSuccess();
        }

        return $this->redirect($this->generateUrl('zimzim_opinion_opinion'));
    }

    /**
     * Creates a form to delete a Opinion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zimzim_opinion_opinion_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'button.delete'))
            ->getForm();
    }

    /**
     * Creates a form to create a Opinion entity.
     *
     * @param Opinion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Opinion $entity)
    {
        $form = $this->createForm(
            new OpinionType(),
            $entity,
            array(
                'action' => $this->generateUrl('zimzim_opinion_opinion_create'),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.create'));

        return $form;
    }
}