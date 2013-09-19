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

use Merlin\TvShowsBundle\Form as Form;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package     R-Infiniti
 * @author      Daniel Jeznach <daniel.jeznach@smtsoftware.com>
 */
class AssetController extends Controller
{
    /**
     * For TB fonts (quickie)
     *
     * @param  string $name
     * @return Response
     */
    public function fontsAction($name)
    {
        $root = realpath($this->get('kernel')->getRootDir() . '/../');
        $fontPath = $root . '/vendor/twitter/bootstrap/fonts/' . $name;
        $data = file_get_contents($fontPath);

        return new Response($data);
    }
}
