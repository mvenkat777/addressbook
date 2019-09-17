<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends Controller
{
    /**
     * @Route("/welcome", name="welcomepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('welcome.html.twig', [
            'dark_world' => 'Welcome to Dark World',
        ]);
    }
}
