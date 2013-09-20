<?php
/**
 * TvShow class container 
 *
 * @package     R-Infiniti
 * @version     $Id$
 * @copyright   2013 SMT Software S.A.
 * @filesource
 */
namespace Merlin\TvShowsBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @package     R-Infiniti
 * @author      Daniel Jeznach <daniel.jeznach@smtsoftware.com>
 *
 * @ORM\Entity
 * @ORM\Table(name="tv_shows")
 */
class TvShow 
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var string
     * @ORM\Column(name="title", type="string", unique=true, length=255)
     */
    protected $title;

    /**
     * @var int
     * @ORM\Column(name="season", type="integer")
     */
    protected $season;

    /**
     * @var int
     * @ORM\Column(name="episode", type="integer")
     */
    protected $episode;

    /**
     * @var int
     * @ORM\Column(name="last_update", type="datetime")
     */
    protected $lastUpdate;

    /**
     * Update access time
     *
     * @author Daniel Jeznach <daniel.jeznach@smtsoftware.com>
     * @access public
     *
     * @return TvShow
     */
    public function updateAccess()
    {
        $this->setLastUpdate(new \DateTime);
        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return TvShow
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set season
     *
     * @param integer $season
     * @return TvShow
     */
    public function setSeason($season)
    {
        $this->season = $season;
        return $this;
    }

    /**
     * Get season
     *
     * @return integer 
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Set episode
     *
     * @param integer $episode
     * @return TvShow
     */
    public function setEpisode($episode)
    {
        $this->episode = $episode;
        return $this;
    }

    /**
     * Get episode
     *
     * @return integer 
     */
    public function getEpisode()
    {
        return $this->episode;
    }

    /**
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     * @return TvShow
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
        return $this;
    }

    /**
     * Get _lastUpdate
     *
     * @return \DateTime 
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * Set next episode
     *
     * @author Daniel Jeznach <daniel.jeznach@smtsoftware.com>
     * @access public
     *
     * @return TvShow
     */
    public function nextEpisode()
    {
        $this->episode++;
        return $this;
    }

    /**
     * Set previous episode
     *
     * @author Daniel Jeznach <daniel.jeznach@smtsoftware.com>
     * @access public
     *
     * @return TvShow
     */
    public function previousEpisode()
    {
        if ($this->episode > 1) {
            $this->episode--;
        }

        return $this;
    }
}
