<?php
/**
 * AbstractController class container 
 *
 * @package     R-Infiniti
 * @version     $Id$
 * @copyright   2013 SMT Software S.A.
 * @filesource
 */
namespace Merlin\TvShowsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package     R-Infiniti
 * @author      Daniel Jeznach <daniel.jeznach@smtsoftware.com>
 */
abstract class AbstractController extends Controller
{

    public function flashMessage($message, $type)
    {
        $this->get('session')
            ->getFlashBag()
            ->add($type, $message);
    }
}
