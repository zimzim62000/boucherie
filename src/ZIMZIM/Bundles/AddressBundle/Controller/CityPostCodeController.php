<?php

namespace ZIMZIM\Bundles\AddressBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ZIMZIM\Controller\ZimzimController;

class CityPostCodeController extends ZimzimController
{
    /**
     * Creates a form to create a CityPostCode entity.
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createFindCityPostCodeForm()
    {
        $form = $this->createForm(
            'zimzim_address_type_citypostcodelinktype',
            null,
            array(
                'action' => $this->generateUrl('zimzim_address_citypostcode_findcitypostcode'),
                'method' => 'POST',
            )
        );
        return $form;
    }


    public function findCityOrPostCodeAction(Request $request)
    {
        $form = $this->createFindCityPostCodeForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            $value = $data['citypostcode'];

            $em = $this->getDoctrine()->getManager();

            $entities = $em->getRepository('ZIMZIMBundlesAddressBundle:CityPostCode')->findByPostCodeOrCity(
                $value,
                $value
            );

            die(json_encode(
                array(
                    array(
                        'id' => 'container-autocompletecity',
                        'template' => $this->renderView(
                                'ZIMZIMBundlesAddressBundle:CityPostCode:container.html.twig',
                                array(
                                    'entities' => $entities
                                )
                            )
                    )
                )
            ));
        }
        die(json_encode(
            array()
        ));
    }

    public function showCityPostCodeByUnikAction($unik)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMBundlesAddressBundle:CityPostCode')->findOneBy(array('unik' => $unik));

        if (!$entity) {
            throw new NotFoundHttpException('No city found ...');
        }

        $entities = $em->getRepository('ZIMZIMBundlesAddressBundle:CityPostCode')->findByUnikAndDistance(
            $entity,
            15,
            10
        );

        return $this->render('ZIMZIMBundlesAddressBundle:CityPostCode:show.html.twig', array('entities' => $entities));
    }
}