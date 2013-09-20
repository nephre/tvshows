<?php
/**
 * Isohunt class container 
 *
 * @package     R-Infiniti
 * @version     $Id$
 * @copyright   2013 SMT Software S.A.
 * @filesource
 */
namespace Merlin\TvShowsBundle\SearchProvider;

use Merlin\TvShowsBundle\Entity\SearchResult;
use Goutte\Client;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\Link;
/**
 * @package     R-Infiniti
 * @author      Daniel Jeznach <daniel.jeznach@smtsoftware.com>
 */
class Isohunt extends AbstractSearchProvider
{
    /**
     * Returns URL to the results page
     *
     * @author Daniel Jeznach <daniel.jeznach@smtsoftware.com>
     * @access public
     *
     * @param  string
     * @return string
     */
    public function getSearchUrl($query)
    {
        return sprintf('http://isohunt.com/torrents/%s?iht=-1&ihp=1&ihs1=1&iho1=d',urlencode($query));
    }

    /**
     * Return result objects
     *
     * @author Daniel Jeznach <daniel.jeznach@smtsoftware.com>
     * @access public
     *
     * @param  string $url
     * @return SearchResult[]
     */
    public function getResult($url)
    {
        $client = new Client;
        $crawler = $client->request('GET', $url);
        $results = $crawler->filter('tr.hlRow')->each(function(Crawler $node, $i) {
            if ($i == 0) {
                return null;
            }
            $result = new SearchResult;
            $result->setName($node->filter('a')->eq(2)->html());
            $result->setUrl($node->filter('a')->eq(3)->link()->getUri());
            $result->setSeeders($node->filter('td')->eq(2)->html());
            $result->setLeechers($node->filter('td')->eq(3)->html());

            return $result;
        });

        unset($results[0]);
        return $results;
    }
}
