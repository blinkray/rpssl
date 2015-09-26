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
            ->add('user_rock', 'submit', array( 'label' => ' ' ))
            ->add('user_paper', 'submit', array( 'label' => ' ' ))
            ->add('user_scissors', 'submit', array( 'label' => ' ' ))
            ->add('user_lizard', 'submit', array( 'label' => ' ' ))
            ->add('user_spock', 'submit', array( 'label' => ' ' ))            
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

        $match = new RpsslMatch();
        $form = $this->createFormBuilder( $match )
            ->setAction($this->generateUrl('game'))
            ->setMethod('POST')
            ->add('user_rock', 'submit', array( 'label' => ' ' ))
            ->add('user_paper', 'submit', array( 'label' => ' ' ))
            ->add('user_scissors', 'submit', array( 'label' => ' ' ))
            ->add('user_lizard', 'submit', array( 'label' => ' ' ))
            ->add('user_spock', 'submit', array( 'label' => ' ' ))            
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
            $matches = $this->get('game.util')->getHistory( $this->getRequest()->getSession()->getId() );
            $stats = $this->get('game.util')->getStats( $this->getRequest()->getSession()->getId() );
            
            
        }
            
        return $this->render('default/play.html.twig', array( 
            'form' => $form->createView(),  
            'the_match' => $match,
            'matches' => $matches,
            'stats' => $stats
        ));
        

        

        

        
    }

}