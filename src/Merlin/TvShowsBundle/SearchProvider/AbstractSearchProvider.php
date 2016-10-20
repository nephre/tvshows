<?php
/**-
 * AbstractSearchProvider class container 
 *
 * @package     R-Infiniti
 * @version     $Id$
 * @copyright   2013 SMT Software S.A.
 * @filesource
 */
namespace Merlin\TvShowsBundle\SearchProvider;

use Merlin\TvShowsBundle\Entity\TvShow;

/**
 * @package     R-Infiniti
 * @author      Daniel Jeznach <daniel.jeznach@smtsoftware.com>
 */
abstract class AbstractSearchProvider 
{
    /**
     * List of class names providing search engine handlers
     * @var array
     */
    protected static $providers = array(
        'ThePirateBay'  => 'The Pirate Bay',
        'Rarbg'         => 'Rarbg',
        'Isohunt'       => 'Isohunt',
    );

    public static function getProviders()
    {
        $output = array();

        foreach (self::$providers as $name => $descrionion) {
            $class = new \stdClass();
            $class->name = $name;
            $class->description = $descrionion;

            $output[] = $class;
        }

        return $output;
    }

    /**
     * @param  string $name
     * @return SearchProviderInterface
     * @throws \InvalidArgumentException
     */
    public static function getProvider($name)
    {
        if (! array_key_exists($name, self::$providers)) {
            throw new \InvalidArgumentException('Unknown provider: ' . $name);
        }

        $class = __NAMESPACE__ . '\\' . $name;
        return new $class;
    }

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
        $query = sprintf('%s %s', $show->getTitle(), $show->getFormattedSeasonEpisode());
        $url = $this->getSearchUrl($query);
        $page = $this->getResult($url);

        return $page;
    }
}
