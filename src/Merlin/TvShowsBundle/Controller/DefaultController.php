<?php

namespace Merlin\TvShowsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MerlinTvShowsBundle:Default:index.html.twig'/*, array('name' => $name)*/);
    }
}
