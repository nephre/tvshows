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
use Symfony\Component\HttpFoundation\File\MimeType\FileinfoMimeTypeGuesser;
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
        $fontPath = '/vendor/twitter/bootstrap/fonts/' . $name;
        return $this->getResourceData($fontPath);
    }

    public function cssimagesAction($name)
    {
        $imagesPath = '/vendor/bmatzner/jquery-ui-bundle/Bmatzner/JQueryUIBundle/Resources/public/css/base/images/' . $name;
        return $this->getResourceData($imagesPath);
    }

    protected function getResourceData($path)
    {
        $root = realpath($this->get('kernel')->getRootDir() . '/../');
        $data = file_get_contents($root . $path);
        $mime = $this->getMimeType($root . $path);

        return new Response($data, 200, array('Content-Type' => $mime));
    }

    protected function getMimeType($path) {
        $fi = new FileinfoMimeTypeGuesser();
        $mime = $fi->guess($path);

        return $mime;
    }
}
