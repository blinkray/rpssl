<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PlayController extends Controller
{
    /**
    * @Route("/play/", name="play");
    **/
    public function indexAction(Request $request)
    {        

        return $this->render('default/play.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
    * @Route("/play/{user_choice}", name="game");
    **/
    public function gameAction($user_choice)
    {        

        $comp_choice = rand( 1, 5 );

        return $this->render('default/play.html.twig', array( 
            'user_choice' => $user_choice, 'comp_choice' => $comp_choice            
        ));
    }

}