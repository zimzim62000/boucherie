<?php

namespace ZIMZIM\Bundles\OpinionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use ZIMZIM\Controller\ZimzimController;

class HomePageController extends ZimzimController
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

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $opinions = $em->getRepository('ZIMZIMBundlesOpinionBundle:Opinion')->findLastOpinionGroupByButchery();

        $butchery = $em->getRepository('ZIMZIMBundlesOpinionBundle:Butchery')->findOneBy(array(), array('createdAt' => 'DESC'));

        $citypostcodes = $em->getRepository('ZIMZIMBundlesAddressBundle:CityPostCode')->findBy(array('main' => 1), array('city' => 'ASC'));

        $form = $this->createFindCityPostCodeForm();

        return $this->render(
            'ZIMZIMBundlesOpinionBundle:HomePage:index.html.twig',
            array(
                'form'          => $form->createView(),
                'opinions'      => $opinions,
                'butchery'      => $butchery,
                'citypostcodes'  => $citypostcodes
            )
        );
    }
}

