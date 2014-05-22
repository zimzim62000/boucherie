<?php

namespace ZIMZIM\Bundles\UserBundle\Controller;

use APY\DataGridBundle\Grid\Source\Entity;
use ZIMZIM\Controller\ZimzimController;

class UserController extends ZimzimController
{
    public function indexAction()
    {
        $source = new Entity('ZIMZIMBundlesUserBundle:User');

        $grid = $this->container->get('grid');

        $source->manipulateRow(
            function ($row) {
                $row->setField('name', $row->getEntity()->getFullName());
                return $row;
            }
        );

        $grid->setSource($source);

        return $grid->getGridResponse('ZIMZIMBundlesUserBundle:User:index.html.twig');

    }
}
