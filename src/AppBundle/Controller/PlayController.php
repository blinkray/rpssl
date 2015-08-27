<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\RpsslMatch;

class PlayController extends Controller
{
    /**
    * @Route("/play/", name="play");
    **/
    public function indexAction(Request $request)
    {        
        
        $match = new RpsslMatch();
        $form = $this->createFormBuilder( $match )
            ->setAction($this->generateUrl('game'))
            ->setMethod('POST')
            ->add('user_rock', 'submit', array( 'label' => 'Rock' ))
            ->add('user_paper', 'submit', array( 'label' => 'Paper' ))
            ->add('user_scissors', 'submit', array( 'label' => 'Scissors' ))
            ->add('user_lizard', 'submit', array( 'label' => 'Lizard' ))
            ->add('user_spock', 'submit', array( 'label' => 'Spock' ))            
            ->getForm();

        return $this->render('default/play.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),'form' => $form->createView()
        ));
    }

    /**
    * @Route("/playAction/", name="game");
    **/
    public function gameAction(Request $request)
    {    

        $outcome = "";
        $user_choice = 0;
        $comp_choice = 0;
        $wins = 0;
        $ties = 0;
        $losses = 0;
        $matches = null;

        $comp_rock = 0; 
        $you_rock = 0; 
        $comp_paper = 0;
        $you_paper = 0;  
        $comp_scissors = 0;  
        $you_scissors = 0; 
        $comp_lizard = 0; 
        $you_lizard = 0;
        $comp_spock = 0;
        $you_spock = 0;

        $match = new RpsslMatch();
        $form = $this->createFormBuilder( $match )
            ->setAction($this->generateUrl('game'))
            ->setMethod('POST')
            ->add('user_rock', 'submit', array( 'label' => 'Rock' ))
            ->add('user_paper', 'submit', array( 'label' => 'Paper' ))
            ->add('user_scissors', 'submit', array( 'label' => 'Scissors' ))
            ->add('user_lizard', 'submit', array( 'label' => 'Lizard' ))
            ->add('user_spock', 'submit', array( 'label' => 'Spock' ))            
            ->getForm();    
        $form->handleRequest($request);

        if(
            $form->get('user_rock')->isClicked() ||
            $form->get('user_paper')->isClicked() ||
            $form->get('user_scissors')->isClicked() ||
            $form->get('user_lizard')->isClicked() ||
            $form->get('user_spock')->isClicked()

            ) {
            
            //set some data for this match
            $match->setUserSid( $this->getRequest()->getSession()->getId() );
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
            $em = $this->getDoctrine()->getManager();
            $em->persist( $match );
            $em->flush();
            
            //fetch match history for stats            
            $repository = $this->getDoctrine()
                ->getRepository('AppBundle:RpsslMatch');
            $matches = $repository->findBy(
                array('user_sid' => $match->getUserSid() ),
                array('created' => 'DESC')
            );

            $comp_rock = 0; 
        $you_rock = 0; 
        $comp_paper = 0;
        $you_paper = 0;  
        $comp_scissors = 0;  
        $you_scissors = 0; 
        $comp_lizard = 0; 
        $you_lizard = 0;
        $comp_spock = 0;
        $you_spock = 0;


            //get some stats to show score
            foreach (  $matches as $rep_match ) {
                if( $rep_match->getUserRock() == 1 ) {
                    $you_rock += 1;
                }
                if( $rep_match->getCompRock() == 1 ) {
                    $comp_rock += 1;
                }

                if( $rep_match->getUserPaper() == 1 ) {
                    $you_paper += 1;
                }
                if( $rep_match->getCompPaper() == 1 ) {
                    $comp_paper += 1;
                }

                if( $rep_match->getUserScissors() == 1 ) {
                    $you_scissors += 1;
                }
                if( $rep_match->getCompScissors() == 1 ) {
                    $comp_scissors += 1;
                }

                if( $rep_match->getUserLizard() == 1 ) {
                    $you_lizard += 1;
                }
                if( $rep_match->getCompLizard() == 1 ) {
                    $comp_lizard += 1;
                }

                if( $rep_match->getUserSpock() == 1 ) {
                    $you_spock += 1;
                }
                if( $rep_match->getCompSpock() == 1 ) {
                    $comp_spock += 1;
                }

                if( $rep_match->getUserWon() ) {
                    $wins += 1;
                }
                if( $rep_match->getCompWon() ) {
                    $losses += 1;
                }
                if( $rep_match->getUserCompTie() ) {
                    $ties += 1;
                }
            }
        }
            
        return $this->render('default/play.html.twig', array( 
            'form' => $form->createView(),  
            'the_match' => $match,
            'matches' => $matches,
            'wins' => $wins,
            'losses' => $losses,
            'ties' => $ties,
            'comp_rock' => $comp_rock, 
            'you_rock' => $you_rock,
            'comp_paper' => $comp_paper,
            'you_paper' => $you_paper,
            'comp_scissors' => $comp_scissors,  
            'you_scissors' => $you_scissors,
            'comp_lizard' => $comp_lizard, 
            'you_lizard' => $you_lizard,
            'comp_spock' => $comp_spock,
            'you_spock' => $you_spock,
        ));

        

        
    }

}