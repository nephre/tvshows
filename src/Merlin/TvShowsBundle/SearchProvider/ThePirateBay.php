<?php
/**
 * ThePirateBay class container 
 *
 * @package     R-Infiniti
 * @version     $Id$
 * @copyright   2013 SMT Software S.A.
 * @filesource
 */
namespace Merlin\TvShowsBundle\SearchProvider;

use Goutte\Client;
use Merlin\TvShowsBundle\Entity\SearchResult;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\Link;

/**
 * thepiratebay.sx search provider
 *
 * @package     R-Infiniti
 * @author      Daniel Jeznach <daniel.jeznach@smtsoftware.com>
 */
class ThePirateBay extends AbstractSearchProvider
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
        return sprintf('http://thepiratebay.se/search/%s/0/7/0', urlencode($query));
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
        $results = $crawler->filter('tr')->each(function(Crawler $node, $i) {
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
