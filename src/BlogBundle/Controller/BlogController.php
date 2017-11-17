<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 11.11.17
 * Time: 20:22
 */

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BlogController extends Controller
{
    /**
     * @Route("/blog", name="blog")
     */
    public function indexAction(Scripts $scripts) {
        return $this->render(':blog:index.html.twig', [
            "title" => "Blog Index",
            "scripts" => $scripts->getScripts()
        ]);
    }

    /**
     * @Route("/blog-item", name="blog_item")
     */
    public function showAction(Scripts $scripts) {
        return $this->render(":blog:show.html.twig", [
            "scripts" => $scripts->getScripts()
        ]);
    }
}