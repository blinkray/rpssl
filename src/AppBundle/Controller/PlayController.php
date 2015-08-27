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
        $losses = 0;
        $matches = null;
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
                    $outcome = "TIE";
                    $match->setCompRock( 1 );
                    $match->setUserCompTie( true );  
                }
                else {
                    $match->setUserCompTie( false );
                    if( $comp_choice == 2 || $comp_choice == 5 ) {
                        $outcome = "YOU LOSE";
                        $match->setCompWon( true );
                    }                    
                    else {
                        $outcome = "YOU WIN";
                        $match->setUserWon( true );
                    }
                }
                
            }

            // game logic - who wins this "match" if user clicks PAPER?
            if ( $form->get('user_paper')->isClicked() ) {
                $user_choice = 2;                
                $match->setUserPaper( 1 );
                if( $user_choice == $comp_choice ){
                    $outcome = "TIE";
                    $match->setCompPaper( 1 );
                    $match->setUserCompTie( true );
                }
                else {                    
                    if( $comp_choice == 3 || $comp_choice == 4 ) {
                        $outcome = "YOU LOSE";
                        $match->setCompWon( true );
                    }                    
                    else {
                        $outcome = "YOU WIN";
                        $match->setUserWon( true );
                    }
                }
            }

            // game logic - who wins this "match" if user clicks SCISSORS?
            if ( $form->get('user_scissors')->isClicked() ) {
                $user_choice = 3;
                $match->setUserScissors( 1 );                
                if( $user_choice == $comp_choice ){
                    $outcome = "TIE";
                    $match->setCompScissors( 1 );
                    $match->setUserCompTie( true );
                }
                else {
                    if( $comp_choice == 5 || $comp_choice == 1 ) {
                        $outcome = "YOU LOSE";
                        $match->setCompWon( true );
                    }                    
                    else {
                        $outcome = "YOU WIN";
                        $match->setUserWon( true );
                    }
                }
            }

            // game logic - who wins this "match" if user clicks LIZARD?
            if ( $form->get('user_lizard')->isClicked() ) {
                $user_choice = 4;
                $match->setUserLizard( 1 );
                if( $user_choice == $comp_choice ){
                    $outcome = "TIE";
                    $match->setCompLizard( 1 );
                    $match->setUserCompTie( true );
                }
                else {
                    if( $comp_choice == 3 || $comp_choice == 1 ) {
                        $outcome = "YOU LOSE";
                        $match->setCompWon( true );
                    }                    
                    else {
                        $outcome = "YOU WIN";
                        $match->setUserWon( true );
                    }
                }
            }

            // game logic - who wins this "match" if user clicks SPOCK?
            if ( $form->get('user_spock')->isClicked() ) {
                $user_choice = 5;
                $match->setUserSpock( 1 );
                if( $user_choice == $comp_choice ){
                    $outcome = "TIE";
                    $match->setCompSpock( 1 );
                    $match->setUserCompTie( true );
                }
                else {
                    if( $comp_choice == 4 || $comp_choice == 2 ) {
                        $outcome = "YOU LOSE";
                        $match->setCompWon( true );
                    }                    
                    else {
                        $outcome = "YOU WIN";
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

            //get some stats to show score
            foreach (  $matches as $rep_match ) {
                if( $rep_match->getUserWon() ) {
                    $wins += 1;
                }
                else {
                    $losses += 1;
                }
            }
        }
            
        return $this->render('default/play.html.twig', array( 
            'form' => $form->createView(),  'user_choice' => $user_choice, 
            'comp_choice' => $comp_choice,  
            'outcome' => $outcome,  
            'matches' => $matches,
            'wins' => $wins,
            'losses' => $losses,
        ));

        

        
    }

}