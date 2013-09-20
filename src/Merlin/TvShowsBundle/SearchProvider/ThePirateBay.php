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
use Merlin\TvShowsBundle\Entity\TvShow;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\Link;

/**
 * thepiratebay.sx search provider
 *
 * @package     R-Infiniti
 * @author      Daniel Jeznach <daniel.jeznach@smtsoftware.com>
 */
class ThePirateBay implements SearchProviderInterface
{
    /** @var TvShow */
    protected $_show;

    /**
     * Perform search and return array of urls
     *
     * @author Daniel Jeznach <daniel.jeznach@smtsoftware.com>
     * @access public
     *
     * @param  TvShow $show
     * @return array
     */
    public function search(TvShow $show)
    {
        $season = str_pad($show->getSeason(), 2, '0', STR_PAD_LEFT);
        $episode = str_pad($show->getEpisode(), 2, '0', STR_PAD_LEFT);
        $query = sprintf('%s S%sE%s', $show->getTitle(), $season, $episode);
        $url = $this->getSearchUrl($query);
        $page = $this->getResult($url);

        return $page;
    }

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
        return sprintf('http://thepiratebay.sx/search/%s/0/7/0', urlencode($query));
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
