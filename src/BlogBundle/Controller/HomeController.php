<?php

namespace BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Scripts $scripts)
    {
        return $this->render('::index.html.twig', [
            "scripts" => $scripts->getScripts()
        ]);
    }
}
