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
    /** @var string */
    protected $_query;

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
        $this->_query = urlencode($query);
        return sprintf('http://isohunt.to/torrents?ihq=%s&Torrent_sort=seeders', $this->_query);
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
        $query = $this->_query;
        $results = $crawler->filter('tr.hlRow')->each(function(Crawler $node, $i) use ($query) {
            if ($i == 0) {
                return null;
            }

            // get torrent id
            $detailsLink = $node->filter('a')->eq(1)->link()->getUri();

            // "torrent verified" - move to another link. Lame solution, will work sth clean later
            if (strpos($detailsLink, 'torrent_details') === false) {
                $detailsLink = $node->filter('a')->eq(2)->link()->getUri();
                $titleIdx = 3;
            } else {
                $titleIdx = 2;
            }

            preg_match('|^.+/torrent_details/([0-9]+)/.+$|', $detailsLink, $matches);
            $torrentId = $matches[1];
//            $torrentUrl = sprintf('http://ca.isohunt.com/download/%s/%s.torrent', $torrentId, $query);
            // Isohunt probably checks referer url, thus direct url to torrent does not work.
            // fix it later...
            $torrentUrl = sprintf('http://isohunt.to/torrent_details/%s/%s.torrent', $torrentId, $query);

            $result = new SearchResult;
            $result->setName($node->filter('a')->eq($titleIdx)->text());
            $result->setUrl($torrentUrl);
            $result->setSeeders($node->filter('td')->eq(4)->html());
            $result->setLeechers($node->filter('td')->eq(5)->html());

            return $result;
        });

        unset($results[0]);
        return $results;
    }
}
