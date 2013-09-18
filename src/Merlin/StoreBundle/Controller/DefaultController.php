<?php

namespace Merlin\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MerlinStoreBundle:Default:index.html.twig', array('name' => $name));
    }
}
