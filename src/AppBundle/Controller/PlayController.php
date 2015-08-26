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
        $user_choice = 0;
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
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),'form' => $form->createView(),
            'user_choice' => $user_choice,
        ));
    }

    /**
    * @Route("/playAction/", name="game");
    **/
    public function gameAction(Request $request)
    {    
        $user_choice = 0;
        $comp_choice = 0;
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

        if ( $form->get('user_rock')->isClicked() ) {
            $user_choice = 1;
        }
        if ( $form->get('user_paper')->isClicked() ) {
            $user_choice = 2;
        }
        if ( $form->get('user_scissors')->isClicked() ) {
            $user_choice = 3;
        }
        if ( $form->get('user_lizard')->isClicked() ) {
            $user_choice = 4;
        }
        if ( $form->get('user_spock')->isClicked() ) {
            $user_choice = 5;
        }
        $comp_choice = rand( 1, 5 );



        return $this->render('default/play.html.twig', array( 
                'form' => $form->createView(),  'user_choice' => $user_choice,  'comp_choice' => $comp_choice,        
            ));
/*
        if ( $form->isValid() ) {

            $comp_choice = rand( 1, 5 );

            return $this->render('default/play.html.twig', array( 
                //'user_choice' => $user_choice, 'comp_choice' => $comp_choice            
            ));
        }
        */
    }

}