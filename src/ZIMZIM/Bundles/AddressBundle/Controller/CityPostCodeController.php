<?php

namespace ZIMZIM\Bundles\AddressBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
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
            'zimzim_address_type_citypostcodetype',
            null,
            array(
                'action' => $this->generateUrl('zimzim_address_citypostcode_findcitypostcode'),
                'method' => 'POST',
            )
        );
        $form->add('submit', 'submit', array('label' => 'button.find'));

        return $form;
    }


    public function findCityOrPostCodeAction(Request $request)
    {
        $form = $this->createFindCityPostCodeForm();

        $form->handleRequest($request);

        $data = $form->getData();

        $value = $data['citypostcode'];

        $em = $this->getDoctrine()->getManager();

        $entities = array();

        foreach ($em->getRepository('ZIMZIMBundlesAddressBundle:CityPostCode')->findByPostCodeOrCity(
                     $value,
                     $value
                 ) as $entity) {
            $entities[] = $entity->getData();
        };

        die(json_encode($entities));

    }


}

