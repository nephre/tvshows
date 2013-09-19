<?php

namespace Merlin\TvShowsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Merlin\TvShowsBundle\Entity;
use Doctrine;

class DefaultController extends Controller
{
    public function indexAction()
    {
        /** @var Doctrine\ORM\EntityManager $em*/
        $em = $this->getDoctrine()->getManager();
        $shows = $em
            ->createQuery('SELECT t FROM MerlinTvShowsBundle:TvShow t ORDER BY t.title ASC')
            ->execute();

        return $this->render('MerlinTvShowsBundle:Default:index.html.twig', array('shows' => $shows));
    }
}
