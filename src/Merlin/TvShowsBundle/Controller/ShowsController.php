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
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
/**
 * @package     R-Infiniti
 * @author      Daniel Jeznach <daniel.jeznach@smtsoftware.com>
 */
class ShowsController extends Controller
{
    public function addAction()
    {
        $show = new TvShow;
        $form = $this->createForm('merlin_tvshowsbundle_tvshow', $show);

        $request = Request::createFromGlobals();

        if ($request->isMethod('POST')) {
            $form->submit($request);

            if ($form->isValid()) {
                $show->upateAccess();

                // save data to db
                $em = $this->getDoctrine()->getManager();
                $em->persist($show);
                $em->flush();

                $response = new RedirectResponse($this->generateUrl('merlin_tv_shows_homepage'));
                $response->prepare($request);

                return $response->send();
            } else {
                $errors = $this->get('validator')->validate($show);
                return $this->render('MerlinTvShowsBundle:Shows:validate.html.twig', array('form' => $form->createView(), 'errors' => $errors, 'active' => 'add'));
            }
        }

        return $this->render('MerlinTvShowsBundle:Shows:add.html.twig', array('form' => $form->createView(), 'active' => 'add'));
    }

    public function editAction()
    {

    }
}
