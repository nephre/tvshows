<?php
/**
 * ShowsController class container 
 *
 * @package     R-Infiniti
 * @version     $Id$
 * @copyright   2013 SMT Software S.A.
 * @filesource
 */
namespace Merlin\TvShowsBundle\Controller;

use Merlin\TvShowsBundle\Entity\TvShow;
use Merlin\TvShowsBundle\Form as Form;
use Merlin\TvShowsBundle\SearchProvider\AbstractSearchProvider;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @package     R-Infiniti
 * @author      Daniel Jeznach <daniel.jeznach@smtsoftware.com>
 */
class ShowsController extends AbstractController
{
    public function indexAction()
    {
        /** @var EntityManager $em*/
        $em = $this->getDoctrine()->getManager();
        $shows = $em
            ->createQuery('SELECT t FROM MerlinTvShowsBundle:TvShow t ORDER BY t.title ASC')
            ->execute();

        return $this->render(
            'MerlinTvShowsBundle:Shows:index.html.twig',
            array('shows' => $shows, 'providers' => AbstractSearchProvider::getProviders(), 'shows_active' => true));
    }

    public function addAction()
    {
        $show = new TvShow;
        $form = $this->createForm('merlin_tvshowsbundle_tvshow', $show);
        $request = Request::createFromGlobals();

        if ($request->isMethod('POST')) {
            $form->submit($request);

            if ($form->isValid()) {
                $show->updateAccess();

                // save data to db
                $em = $this->getDoctrine()->getManager();
                $em->persist($show);
                $em->flush();

                $this->flashMessage('"' . $show->getTitle() . '" has been added.', 'notice');

                $response = new RedirectResponse($this->generateUrl('merlin_tv_shows_homepage'));
                $response->prepare($request);

                return $response->send();
            } else {
                $errors = $this->get('validator')->validate($show);
                return $this->render('MerlinTvShowsBundle:Shows:validate.html.twig', array('form' => $form->createView(), 'errors' => $errors, 'active' => 'add'));
            }
        }

        return $this->render(
            'MerlinTvShowsBundle:Shows:add.html.twig',
            array('form' => $form->createView(), 'active' => 'add', 'add_show_active' => true));
    }

    public function editAction($id)
    {
        /** @var TvShow $show */
        $show = $this
            ->getDoctrine()
            ->getRepository('MerlinTvShowsBundle:TvShow')
            ->find($id);

        if (! $show) {
            throw $this->createNotFoundException('Show not found: id ' . $id);
        }

        $form = $this->createForm('merlin_tvshowsbundle_tvshow', $show);
        $request = Request::createFromGlobals();

        if ($request->isMethod('POST')) {
            $form->submit($request);

            if ($form->isValid()) {
                $show->updateAccess();

                $em = $this->getDoctrine()->getManager();
                $em->persist($show);
                $em->flush();

                $this->flashMessage('"' . $show->getTitle() . '" has been updated', 'notice');

                $response = new RedirectResponse($this->generateUrl('merlin_tv_shows_homepage'));
                return $response->send();
            }
        }

        return $this->render('MerlinTvShowsBundle:Shows:edit.html.twig', array('form' => $form->createView(), 'id' => $id));
    }

    public function deleteAction($id){
        /** @var TvShow $show */
        $show = $this
            ->getDoctrine()
            ->getRepository('MerlinTvShowsBundle:TvShow')
            ->find($id);

        if (! $show) {
            throw $this->createNotFoundException('Show not found: id ' . $id);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($show);
        $em->flush();

        $this->flashMessage('"' . $show->getTitle() . '" has been removed.', 'notice');

        $response = new RedirectResponse($this->generateUrl('merlin_tv_shows_homepage'));
        return $response->send();
    }

    public function searchAction($id, $provider)
    {
        /** @var TvShow $show */
        $show = $this
            ->getDoctrine()
            ->getRepository('MerlinTvShowsBundle:TvShow')
            ->find($id);

        if (! $show) {
            throw $this->createNotFoundException('Show not found: id ' . $id);
        }

        $searchProvider = AbstractSearchProvider::getProvider($provider);
        $results = $searchProvider->search($show);

        return $this->render(
            'MerlinTvShowsBundle:Shows:search.html.twig',
            array('results' => $results, 'shows_active' => true));
    }

    public function episodeAction($id, $mode)
    {
        /** @var TvShow $show */
        $show = $this
            ->getDoctrine()
            ->getRepository('MerlinTvShowsBundle:TvShow')
            ->find($id);

        if (! $show) {
            throw $this->createNotFoundException('Show not found: id ' . $id);
        }

        if ($mode == 'next') {
            $show->nextEpisode();
        } else if ($mode == 'previous') {
            $show->previousEpisode();
        }

        $show->updateAccess();

        $em = $this->getDoctrine()->getManager();
        $em->persist($show);
        $em->flush();

        $response = new RedirectResponse($this->generateUrl('merlin_tv_shows_homepage'));
        $response->send();
    }
}
