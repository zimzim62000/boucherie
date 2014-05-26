<?php

namespace ZIMZIM\Bundles\OpinionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use ZIMZIM\Controller\ZimzimController;

class HomePageController extends ZimzimController
{
    public function indexAction(Request $request)
    {
        return $this->render(
            'ZIMZIMBundlesOpinionBundle:HomePage:index.html.twig');
    }
}

