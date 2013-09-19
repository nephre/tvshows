<?php
/**
 * SearchResult class container 
 *
 * @package     R-Infiniti
 * @version     $Id$
 * @copyright   2013 SMT Software S.A.
 * @filesource
 */
namespace Merlin\TvShowsBundle\Entity;
/**
 * Representation of search result
 *
 * @package     R-Infiniti
 * @author      Daniel Jeznach <daniel.jeznach@smtsoftware.com>
 */
class SearchResult 
{
    /** @var  string */
    protected $name;

    /** @var string */
    protected $url;

    /** @var int */
    protected $seeders;

    /** @var int */
    protected $leechers;

    /**
     * Getter for $name
     *
     * @author Daniel Jeznach <daniel.jeznach@smtsoftware.com>
     * @access public
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Setter for $name
     *
     * @author Daniel Jeznach <daniel.jeznach@smtsoftware.com>
     * @access public
     *
     * @param  string $name
     * @return SearchResult
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Getter for $url
     *
     * @author Daniel Jeznach <daniel.jeznach@smtsoftware.com>
     * @access public
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Setter for $url
     *
     * @author Daniel Jeznach <daniel.jeznach@smtsoftware.com>
     * @access public
     *
     * @param  string $url
     * @return SearchResult
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Getter for $seeders
     *
     * @author Daniel Jeznach <daniel.jeznach@smtsoftware.com>
     * @access public
     *
     * @return int
     */
    public function getSeeders()
    {
        return $this->seeders;
    }

    /**
     * Setter for $seeders
     *
     * @author Daniel Jeznach <daniel.jeznach@smtsoftware.com>
     * @access public
     *
     * @param  int $seeders
     * @return SearchResult
     */
    public function setSeeders($seeders)
    {
        $this->seeders = $seeders;
        return $this;
    }

    /**
     * Getter for $leechers
     *
     * @author Daniel Jeznach <daniel.jeznach@smtsoftware.com>
     * @access public
     *
     * @return int
     */
    public function getLeechers()
    {
        return $this->leechers;
    }

    /**
     * Setter for $leechers
     *
     * @author Daniel Jeznach <daniel.jeznach@smtsoftware.com>
     * @access public
     *
     * @param  int $leechers
     * @return SearchResult
     */
    public function setLeechers($leechers)
    {
        $this->leechers = $leechers;
        return $this;
    }
}
