<?php
namespace BlogBundle\Controller;


use BlogBundle\Entity\User;
use BlogBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends Controller
{
    /**
     * @Route("/register", name="register_form")
     * @Method({"GET"})
     */
    public function getRegisterAction(Scripts $scripts) {
        $user = new User();
        $form = $this->createForm(UserType::class, $user)   ;

        return $this->render(":auth:regiser.html.twig", [
            "scripts" => $scripts->getScripts(),
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/register", name="register_account")
     * @Method({"POST"})
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $encoderInterface, Scripts $scripts) {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isValid()) {
            $password = $encoderInterface->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        } else {
            return $this->render(":auth:regiser.html.twig", [
                "scripts" => $scripts->getScripts(),
                "form" => $form->createView()
            ]);
        }

        echo 'save';
        exit();
    }

}