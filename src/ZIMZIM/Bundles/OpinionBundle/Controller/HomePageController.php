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
            'zimzim_address_type_citypostcodetype',
            null,
            array(
                'action' => $this->generateUrl('zimzim_address_citypostcode_findcitypostcode'),
                'method' => 'POST',
            )
        );
        return $form;
    }

    public function indexAction(Request $request)
    {
        $form = $this->createFindCityPostCodeForm();

        return $this->render(
            'ZIMZIMBundlesOpinionBundle:HomePage:index.html.twig', array('form' => $form->createView()));
    }
}

