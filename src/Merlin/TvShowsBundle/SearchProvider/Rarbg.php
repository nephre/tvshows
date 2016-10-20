<?php
/**
 * Rarbg class container
 */

namespace Merlin\TvShowsBundle\SearchProvider;


use Merlin\TvShowsBundle\Entity\SearchResult;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class Rarbg extends AbstractSearchProvider implements SearchProviderInterface
{
    /** @var string */
    protected $query;

    /**
     * @param string $query
     * @return string
     */
    public function getSearchUrl($query)
    {
        $this->query = urlencode($query);
        return sprintf('https://rarbg.to/torrents.php?search=%s&order=seeders&by=DESC', $this->query);
    }

    public function getResult($url)
    {
        $client = new Client;
        $crawler = $client->request('GET', $url);
        $query = $this->query;
    }

}
