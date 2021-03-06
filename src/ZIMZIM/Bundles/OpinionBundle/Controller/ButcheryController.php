<?php

namespace ZIMZIM\Bundles\OpinionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use ZIMZIM\Bundles\OpinionBundle\Entity\Opinion;
use ZIMZIM\Controller\ZimzimController;

use ZIMZIM\Bundles\OpinionBundle\Entity\Butchery;
use ZIMZIM\Bundles\OpinionBundle\Form\ButcheryType;

/**
 * Butchery controller.
 *
 */
class ButcheryController extends ZimzimController
{

    /**
     * Lists all Butchery entities.
     *
     */
    public function indexAction()
    {
        $data = array(
            'entity' => 'ZIMZIMBundlesOpinionBundle:Butchery',
            'show' => 'zimzim_opinion_butchery_show',
            'edit' => 'zimzim_opinion_butchery_edit'
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

        return $this->grid->getGridResponse('ZIMZIMBundlesOpinionBundle:Butchery:index.html.twig');
    }

    /**
     * Creates a new Butchery entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Butchery();

        if ($request->isXmlHttpRequest()) {

            $form = $this->createCreateForm($entity, 'ajax');
            $form->handleRequest($request);

            die(json_encode(
                array(
                    array(
                        'id' => 'form-zimzim-opinion-butchery',
                        'template' => $this->renderView(
                                'ZIMZIMBundlesOpinionBundle:Butchery:form.html.twig',
                                array(
                                    'form' => $form->createView(),
                                )
                            )
                    )
                )
            ));
        }

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->createSuccess();
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);

            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_opinion_butchery_show', array('id' => $entity->getId())));
        }

        return $this->render(
            'ZIMZIMBundlesOpinionBundle:Butchery:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a form to create a Butchery entity.
     *
     * @param Butchery $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Butchery $entity, $validation = 'Default')
    {
        $form = $this->createForm(
            new ButcheryType(),
            $entity,
            array(
                'action' => $this->generateUrl('zimzim_opinion_butchery_create'),
                'method' => 'POST',
                'validation_groups' => array($validation)
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.create'));

        return $form;
    }

    /**
     * Displays a form to create a new Butchery entity.
     *
     */
    public function newAction()
    {
        $entity = new Butchery();
        $form = $this->createCreateForm($entity);

        return $this->render(
            'ZIMZIMBundlesOpinionBundle:Butchery:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Finds and displays a Butchery entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:Butchery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Butchery entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMBundlesOpinionBundle:Butchery:show.html.twig',
            array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Displays a form to edit an existing Butchery entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:Butchery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Butchery entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMBundlesOpinionBundle:Butchery:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Creates a form to edit a Butchery entity.
     *
     * @param Butchery $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Butchery $entity, $validation = 'Default')
    {
        $form = $this->createForm(
            new ButcheryType(),
            $entity,
            array(
                'action' => $this->generateUrl('zimzim_opinion_butchery_update', array('id' => $entity->getId())),
                'method' => 'PUT',
                'validation_groups' => $validation
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }

    /**
     * Edits an existing Butchery entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:Butchery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Butchery entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        if ($request->isXmlHttpRequest()) {

            $editForm = $this->createEditForm($entity, 'ajax');
            $editForm->handleRequest($request);

            die(json_encode(
                array(
                    array(
                        'id' => 'form-zimzim-opinion-butchery',
                        'template' => $this->renderView(
                                'ZIMZIMBundlesOpinionBundle:Butchery:form.html.twig',
                                array(
                                    'form' => $editForm->createView(),
                                )
                            )
                    )
                )
            ));
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $this->updateSuccess();
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_opinion_butchery_edit', array('id' => $id)));
        }

        return $this->render(
            'ZIMZIMBundlesOpinionBundle:Butchery:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Deletes a Butchery entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:Butchery')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Butchery entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->deleteSuccess();
        }

        return $this->redirect($this->generateUrl('zimzim_opinion_butchery'));
    }

    /**
     * Creates a form to delete a Butchery entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zimzim_opinion_butchery_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'button.delete'))
            ->getForm();
    }


    /**
     * Finds and displays a Butchery entity.
     *
     */
    public function showButcheryAction(Request $request, $unik)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesOpinionBundle:Butchery')->findOneBy(array('unik' => $unik));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Butchery entity.');
        }

        $opinion = new Opinion();
        $user = false;
        $myopinion = false;
        if (true === $this->get('security.context')->isGranted('ROLE_USER')) {

            $user = $this->get('security.context')->getToken()->getUser();

            $myopinion = $em->getRepository('ZIMZIMBundlesOpinionBundle:Opinion')->findOneBy(
                array('user' => $user, 'butchery' => $entity)
            );

            $opinion->setButchery($entity);
            $opinion->setUser($user);

        }

        $form = $this->createForm(
            'zimzim_bundles_opinionbundle_opiniontype',
            $opinion,
            array(
                'action' => $this->generateUrl('zimzim_opinion_butchery_showbutchery', array('unik' => $unik)),
                'method' => 'POST'
            )
        );

        if($request->getMethod() === 'POST'){

            $form->handleRequest($request);

            if ($form->isValid()) {

                $this->createSuccess();
                $em = $this->getDoctrine()->getManager();
                $em->persist($opinion);
                $em->flush();

                return $this->redirect($this->generateUrl('zimzim_opinion_butchery_showbutchery', array('unik' => $unik)));
            }
        }


        return $this->render(
            'ZIMZIMBundlesOpinionBundle:Butchery:show.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
                'user' => $user,
                'myopinion' => $myopinion,
                'errors' => $form->getErrors()
            )
        );
    }
}
