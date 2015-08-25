<?php
// src/AppBundle/Entity/RpsslMatch.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="rpssl_match")
*/
class RpsslMatch
{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	protected $id;

	/**
     * @ORM\Column(type="string", length=100)
     */
    protected $user_sid;

    /**
     * @ORM\Column(type="integer")
     */
    protected $user_rock;

    /**
     * @ORM\Column(type="integer")
     */
    protected $user_paper;

    /**
     * @ORM\Column(type="integer")
     */
    protected $user_scissors;

    /**
     * @ORM\Column(type="integer")
     */
    protected $user_lizard;

    /**
     * @ORM\Column(type="integer")
     */
    protected $user_spock;

    /**
     * @ORM\Column(type="integer")
     */
    protected $comp_rock;

    /**
     * @ORM\Column(type="integer")
     */
    protected $comp_paper;

    /**
     * @ORM\Column(type="integer")
     */
    protected $comp_scissors;

    /**
     * @ORM\Column(type="integer")
     */
    protected $comp_lizard;

    /**
     * @ORM\Column(type="integer")
     */
    protected $comp_spock;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $user_won;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $comp_won;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $user_comp_tie;

    /**
     * @ORM\Column(type="datetime")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $created;

    /**
     * @ORM\Column(type="datetime")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $modified;

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
     * Set user_sid
     *
     * @param string $userSid
     * @return Match
     */
    public function setUserSid($userSid)
    {
        $this->user_sid = $userSid;

        return $this;
    }

    /**
     * Get user_sid
     *
     * @return string 
     */
    public function getUserSid()
    {
        return $this->user_sid;
    }

    /**
     * Set user_rock
     *
     * @param integer $userRock
     * @return Match
     */
    public function setUserRock($userRock)
    {
        $this->user_rock = $userRock;

        return $this;
    }

    /**
     * Get user_rock
     *
     * @return integer 
     */
    public function getUserRock()
    {
        return $this->user_rock;
    }

    /**
     * Set user_paper
     *
     * @param integer $userPaper
     * @return Match
     */
    public function setUserPaper($userPaper)
    {
        $this->user_paper = $userPaper;

        return $this;
    }

    /**
     * Get user_paper
     *
     * @return integer 
     */
    public function getUserPaper()
    {
        return $this->user_paper;
    }

    /**
     * Set user_scissors
     *
     * @param integer $userScissors
     * @return Match
     */
    public function setUserScissors($userScissors)
    {
        $this->user_scissors = $userScissors;

        return $this;
    }

    /**
     * Get user_scissors
     *
     * @return integer 
     */
    public function getUserScissors()
    {
        return $this->user_scissors;
    }

    /**
     * Set user_lizard
     *
     * @param integer $userLizard
     * @return Match
     */
    public function setUserLizard($userLizard)
    {
        $this->user_lizard = $userLizard;

        return $this;
    }

    /**
     * Get user_lizard
     *
     * @return integer 
     */
    public function getUserLizard()
    {
        return $this->user_lizard;
    }

    /**
     * Set user_spock
     *
     * @param integer $userSpock
     * @return Match
     */
    public function setUserSpock($userSpock)
    {
        $this->user_spock = $userSpock;

        return $this;
    }

    /**
     * Get user_spock
     *
     * @return integer 
     */
    public function getUserSpock()
    {
        return $this->user_spock;
    }

    /**
     * Set comp_rock
     *
     * @param integer $compRock
     * @return Match
     */
    public function setCompRock($compRock)
    {
        $this->comp_rock = $compRock;

        return $this;
    }

    /**
     * Get comp_rock
     *
     * @return integer 
     */
    public function getCompRock()
    {
        return $this->comp_rock;
    }

    /**
     * Set comp_paper
     *
     * @param integer $compPaper
     * @return Match
     */
    public function setCompPaper($compPaper)
    {
        $this->comp_paper = $compPaper;

        return $this;
    }

    /**
     * Get comp_paper
     *
     * @return integer 
     */
    public function getCompPaper()
    {
        return $this->comp_paper;
    }

    /**
     * Set comp_scissors
     *
     * @param integer $compScissors
     * @return Match
     */
    public function setCompScissors($compScissors)
    {
        $this->comp_scissors = $compScissors;

        return $this;
    }

    /**
     * Get comp_scissors
     *
     * @return integer 
     */
    public function getCompScissors()
    {
        return $this->comp_scissors;
    }

    /**
     * Set comp_lizard
     *
     * @param integer $compLizard
     * @return Match
     */
    public function setCompLizard($compLizard)
    {
        $this->comp_lizard = $compLizard;

        return $this;
    }

    /**
     * Get comp_lizard
     *
     * @return integer 
     */
    public function getCompLizard()
    {
        return $this->comp_lizard;
    }

    /**
     * Set comp_spock
     *
     * @param integer $compSpock
     * @return Match
     */
    public function setCompSpock($compSpock)
    {
        $this->comp_spock = $compSpock;

        return $this;
    }

    /**
     * Get comp_spock
     *
     * @return integer 
     */
    public function getCompSpock()
    {
        return $this->comp_spock;
    }

    /**
     * Set user_won
     *
     * @param boolean $userWon
     * @return Match
     */
    public function setUserWon($userWon)
    {
        $this->user_won = $userWon;

        return $this;
    }

    /**
     * Get user_won
     *
     * @return boolean 
     */
    public function getUserWon()
    {
        return $this->user_won;
    }

    /**
     * Set comp_won
     *
     * @param boolean $compWon
     * @return Match
     */
    public function setCompWon($compWon)
    {
        $this->comp_won = $compWon;

        return $this;
    }

    /**
     * Get comp_won
     *
     * @return boolean 
     */
    public function getCompWon()
    {
        return $this->comp_won;
    }

    /**
     * Set user_comp_tie
     *
     * @param boolean $userCompTie
     * @return Match
     */
    public function setUserCompTie($userCompTie)
    {
        $this->user_comp_tie = $userCompTie;

        return $this;
    }

    /**
     * Get user_comp_tie
     *
     * @return boolean 
     */
    public function getUserCompTie()
    {
        return $this->user_comp_tie;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Match
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return Match
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified()
    {
        return $this->modified;
    }
}
