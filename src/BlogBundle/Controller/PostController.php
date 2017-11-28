<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 11.11.17
 * Time: 20:22
 */

namespace BlogBundle\Controller;

use BlogBundle\Entity\Post;
use BlogBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class PostController extends Controller
{
    /**
     * @Route("/blog", name="blog")
     * @Method({"GET"})
     */
    public function indexAction() {
        $blog = $this->getDoctrine()->getRepository(Post::class)->findAll();

        return $this->render(':blog:index.html.twig', [
            "title" => "Blog Index",
            "blog" => $blog
        ]);
    }

    /**
     * @Route("/blog-item", name="blog_item")
     * @Method({"GET"})
     */
    public function showAction() {
        return $this->render(":blog:show.html.twig");
    }

    /**
     * @Route("/blog", name="insert_post")
     * @Method({"POST"})
     */
    public function insertPostAction(Request $request, UserInterface $user) {
        $post = new Post();
        $post->setUser($user);
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            /** @var UploadedFile $file */
            $file = $post->getCover();
            $blogPath = $this->getParameter("image_directory") . "blog";
            $cover = md5(uniqid()) . '.' . $file->getClientOriginalExtension();

            $file->move($blogPath, $cover);

            $post->setCover($cover);

            $em->persist($post);
            $em->flush();

            return $this->redirect("blog");
        } else {
            return $this->render(":blog:create.html.twig", [
                "form" => $form
            ]);
        }
    }


    /**
     * @Route("/create-post", name="create_post")
     * @Method({"GET"})
     */
    public function getPostFormAction() {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        return $this->render(":blog:create.html.twig", [
            "title" => "Blog Create",
            "form" => $form->createView()
        ]);
    }
}