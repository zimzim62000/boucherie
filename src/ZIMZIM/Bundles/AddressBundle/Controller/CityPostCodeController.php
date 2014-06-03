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
            $value = str_replace(
                array(
                    'à', 'â', 'ä', 'á', 'ã', 'å',
                    'î', 'ï', 'ì', 'í',
                    'ô', 'ö', 'ò', 'ó', 'õ', 'ø',
                    'ù', 'û', 'ü', 'ú',
                    'é', 'è', 'ê', 'ë',
                    'ç', 'ÿ', 'ñ',
                    'À', 'Â', 'Ä', 'Á', 'Ã', 'Å',
                    'Î', 'Ï', 'Ì', 'Í',
                    'Ô', 'Ö', 'Ò', 'Ó', 'Õ', 'Ø',
                    'Ù', 'Û', 'Ü', 'Ú',
                    'É', 'È', 'Ê', 'Ë',
                    'Ç', 'Ÿ', 'Ñ'
                ),
                array(
                    'a', 'a', 'a', 'a', 'a', 'a',
                    'i', 'i', 'i', 'i',
                    'o', 'o', 'o', 'o', 'o', 'o',
                    'u', 'u', 'u', 'u',
                    'e', 'e', 'e', 'e',
                    'c', 'y', 'n',
                    'A', 'A', 'A', 'A', 'A', 'A',
                    'I', 'I', 'I', 'I',
                    'O', 'O', 'O', 'O', 'O', 'O',
                    'U', 'U', 'U', 'U',
                    'E', 'E', 'E', 'E',
                    'C', 'Y', 'N'
                ),
                $data['citypostcode']);

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

        $citiespostcode = $em->getRepository('ZIMZIMBundlesAddressBundle:CityPostCode')->findByUnikAndDistance(
            $entity,
            15,
            10
        );
        $cityPostCodes = array_map(
            function ($tab) {
                return $tab[0];
            },
            $citiespostcode
        );

        $butcheries = $em->getRepository('ZIMZIMBundlesOpinionBundle:Butchery')->findByCityPostCode($cityPostCodes);

        return $this->render(
            'ZIMZIMBundlesAddressBundle:CityPostCode:show.html.twig',
            array('entities' => $butcheries)
        );
    }
}