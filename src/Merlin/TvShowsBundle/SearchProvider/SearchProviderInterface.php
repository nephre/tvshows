<?php
/**
 * SearchProviderInterface class container 
 *
 * @package     R-Infiniti
 * @version     $Id$
 * @copyright   2013 SMT Software S.A.
 * @filesource
 */
namespace Merlin\TvShowsBundle\SearchProvider;

use Merlin\TvShowsBundle\Entity\TvShow;
use Merlin\TvShowsBundle\Entity\SearchResult;

/**
 * Search provider
 *
 * @package     R-Infiniti
 * @author      Daniel Jeznach <daniel.jeznach@smtsoftware.com>
 */
interface SearchProviderInterface
{
    /**
     * Perform search and return array of urls
     *
     * @author Daniel Jeznach <daniel.jeznach@smtsoftware.com>
     * @access public
     *
     * @param  TvShow $show
     * @return array
     */
    public function search(TvShow $show);

    /**
     * Returns URL to the results page
     *
     * @author Daniel Jeznach <daniel.jeznach@smtsoftware.com>
     * @access public
     *
     * @param  string
     * @return string
     */
    public function getSearchUrl($query);

    /**
     * Return result objects
     *
     * @author Daniel Jeznach <daniel.jeznach@smtsoftware.com>
     * @access public
     *
     * @param  string $url
     * @return SearchResult[]
     */
    public function getResult($url);
}
