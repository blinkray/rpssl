<?php

namespace AppBundle\Utils;

use Doctrine\ORM\EntityManager;

class MatchUtil
{
	/**
    * @var EntityManager
    */
	protected $em;
	public function __construct(\Doctrine\ORM\EntityManager $em)
  	{
    	$this->em = $em;
  	}

	/**
    * Populate Match
    * Method to build the match and fill properties
    */
    public function populateMatch( $form, $sessionid, $match ) {

        $match->setUserSid( $sessionid );
        $match->setCreated( new \DateTime() );
        $match->setModified( new \DateTime() );

        //setting initial computer values
        $match->setCompRock( 0 );
        $match->setCompPaper( 0 );
        $match->setCompScissors( 0 );
        $match->setCompLizard( 0 );
        $match->setCompSpock( 0 );
        $match->setCompWon( false );

        $comp_choice = rand( 1, 5 );
        if( $comp_choice == 1 ){
            $match->setCompRock( 1 );
        }
        if( $comp_choice == 2){                
            $match->setCompPaper( 1 );                
        }
        if( $comp_choice == 3){
            $match->setCompScissors( 1 );
        }
        if( $comp_choice == 4){
            $match->setCompLizard( 1 );
        }
        if( $comp_choice == 5){
            $match->setCompSpock( 1 );
        }

        //setting initial user values
        $match->setUserRock( 0 );
        $match->setUserPaper( 0 );
        $match->setUserScissors( 0 );
        $match->setUserLizard( 0 );
        $match->setUserSpock( 0 );
        $match->setUserWon( false );
        $match->setUserCompTie( false );

        // game logic - who wins this "match" if user clicks ROCK?
        if ( $form->get('user_rock')->isClicked() ) {   
            $user_choice = 1;         
            $match->setUserRock( 1 );
            if( $user_choice == $comp_choice ){                    
                $match->setCompRock( 1 );
                $match->setUserCompTie( true );  
            }
            else {
                $match->setUserCompTie( false );
                if( $comp_choice == 2 || $comp_choice == 5 ) {                        
                    $match->setCompWon( true );
                }                    
                else {                        
                    $match->setUserWon( true );
                }
            }
            
        }

        // game logic - who wins this "match" if user clicks PAPER?
        if ( $form->get('user_paper')->isClicked() ) {  
            $user_choice = 2;                          
            $match->setUserPaper( 1 );
            if( $user_choice == $comp_choice ){                    
                $match->setCompPaper( 1 );
                $match->setUserCompTie( true );
            }
            else {                    
                if( $comp_choice == 3 || $comp_choice == 4 ) {                        
                    $match->setCompWon( true );
                }                    
                else {                        
                    $match->setUserWon( true );
                }
            }
        }

        // game logic - who wins this "match" if user clicks SCISSORS?
        if ( $form->get('user_scissors')->isClicked() ) {  
            $user_choice = 3;          
            $match->setUserScissors( 1 );                
            if( $user_choice == $comp_choice ){                    
                $match->setCompScissors( 1 );
                $match->setUserCompTie( true );
            }
            else {
                if( $comp_choice == 5 || $comp_choice == 1 ) {                        
                    $match->setCompWon( true );
                }                    
                else {                        
                    $match->setUserWon( true );
                }
            }
        }

        // game logic - who wins this "match" if user clicks LIZARD?
        if ( $form->get('user_lizard')->isClicked() ) {  
            $user_choice = 4;          
            $match->setUserLizard( 1 );
            if( $user_choice == $comp_choice ){                    
                $match->setCompLizard( 1 );
                $match->setUserCompTie( true );
            }
            else {
                if( $comp_choice == 3 || $comp_choice == 1 ) {                        
                    $match->setCompWon( true );
                }                    
                else {                        
                    $match->setUserWon( true );
                }
            }
        }

        // game logic - who wins this "match" if user clicks SPOCK?
        if ( $form->get('user_spock')->isClicked() ) {
            $user_choice = 5;
            $match->setUserSpock( 1 );
            if( $user_choice == $comp_choice ){                    
                $match->setCompSpock( 1 );
                $match->setUserCompTie( true );
            }
            else {
                if( $comp_choice == 4 || $comp_choice == 2 ) {                        
                    $match->setCompWon( true );
                }                    
                else {                        
                    $match->setUserWon( true );
                }
            }
        }

        //saving this "match" to database
        $this->em->persist( $match );
        $this->em->flush();

        return $match;

    }

    /**
    * Get Stats
    * Method to retrieve statistics for a "user" specified by a sessionId
    */
    public function getStats( $sessionid ) {

    }

}