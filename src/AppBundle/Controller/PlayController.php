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

            $match = $this->get('game.util')->populateMatch( $form, $this->getRequest()->getSession()->getId(), $match );
            $stats = $this->get('game.util')->getStats( $this->getRequest()->getSession()->getId() );
            
            //fetch match history for stats    
            /*        
            $repository = $this->getDoctrine()
                ->getRepository('AppBundle:RpsslMatch');
            $matches = $repository->findBy(
                array('user_sid' => $match->getUserSid() ),
                array('created' => 'DESC')
            );
            */

            //get some stats to show score
            /*
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
            */
        }
            /*
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
        */

        return $this->render('default/play.html.twig', array( 
            'form' => $form->createView(),  
            'the_match' => $match,
            
        ));

        

        
    }

}