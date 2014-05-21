<?php

namespace ZIMZIM\Bundles\UserBundle\Controller;

use ZIMZIM\Controller\ZimzimController;

class DefaultController extends ZimzimController
{
    public function indexAction()
    {
        return $this->render('ZIMZIMBundlesUserBundle:Default:index.html.twig');
    }
}
