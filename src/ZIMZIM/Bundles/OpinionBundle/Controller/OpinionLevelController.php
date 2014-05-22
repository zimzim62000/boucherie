<?php

namespace ZIMZIM\Bundles\OpinionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use ZIMZIM\Controller\ZimzimController;

use ZIMZIM\Bundles\OpinionBundle\Entity\OpinionLevel;
use ZIMZIM\Bundles\OpinionBundle\Form\OpinionLevelType;

/**
 * OpinionLevel controller.
 *
 */
class OpinionLevelController extends ZimzimController
{

    /**
     * Lists all OpinionLevel entities.
     *
     */
    public function indexAction()
    {
    $data = array(
        'entity'     => 'ZIMZIMBundlesOpinionBundle:OpinionLevel',
        'show'       => 'zimzim_opinion_opinionlevel_show',
        'edit'       => 'zimzim_opinion_opinionlevel_edit'
    );

    $this->gridList($data);


   return $this->grid->getGridResponse('ZIMZIMBundlesOpinionBundle:OpinionLevel:index.html.twig');
    }
    /**
     * Creates a new OpinionLevel entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new OpinionLevel();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->createSuccess();
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_opinion_opinionlevel_show', array('id' => $entity->getId())));
        }

        return $this->render('ZIMZIMBundlesOpinionBundle:OpinionLevel:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a OpinionLevel entity.
    *
    * @param OpinionLevel $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(OpinionLevel $entity)
    {
        $form = $this->createForm(new OpinionLevelType(), $entity, array(
            'action' => $this->generateUrl('zimzim_opinion_opinionlevel_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'button.create'));

        return $form;
    }

    /**
     * Displays a form to create a new OpinionLevel entity.
     *
     */
    public function newAction()
    {
        $entity = new OpinionLevel();
        $form   = $this->createCreateForm($entity);

        return $this->render('ZIMZIMBundlesOpinionBundle:OpinionLevel:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a OpinionLevel entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:OpinionLevel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OpinionLevel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZIMZIMBundlesOpinionBundle:OpinionLevel:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing OpinionLevel entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:OpinionLevel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OpinionLevel entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZIMZIMBundlesOpinionBundle:OpinionLevel:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a OpinionLevel entity.
    *
    * @param OpinionLevel $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(OpinionLevel $entity)
    {
        $form = $this->createForm(new OpinionLevelType(), $entity, array(
            'action' => $this->generateUrl('zimzim_opinion_opinionlevel_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }
    /**
     * Edits an existing OpinionLevel entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:OpinionLevel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OpinionLevel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
			$this->updateSuccess();
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_opinion_opinionlevel_edit', array('id' => $id)));
        }

        return $this->render('ZIMZIMBundlesOpinionBundle:OpinionLevel:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a OpinionLevel entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:OpinionLevel')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find OpinionLevel entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->deleteSuccess();
        }

        return $this->redirect($this->generateUrl('zimzim_opinion_opinionlevel'));
    }

    /**
     * Creates a form to delete a OpinionLevel entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zimzim_opinion_opinionlevel_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'button.delete'))
            ->getForm()
        ;
    }
}
