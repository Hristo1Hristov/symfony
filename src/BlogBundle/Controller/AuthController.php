<?php
namespace BlogBundle\Controller;


use BlogBundle\Entity\User;
use BlogBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthController extends Controller
{
    /**
     * @Route("/register", name="register_form")
     * @Method({"GET"})
     */
    public function getRegisterAction() {
        $user = new User();
        $form = $this->createForm(UserType::class, $user)   ;

        return $this->render(":auth:regiser.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/register", name="register_account")
     * @Method({"POST"})
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $encoderInterface) {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isValid()) {
            $password = $encoderInterface->encodePassword($user, $user->getPlainPassword());

            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirect("login_page");
        } else {
            return $this->render(":auth:regiser.html.twig", [
                "form" => $form->createView()
            ]);
        }
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(AuthenticationUtils $authenticationUtils) {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(":auth:login.html.twig", [
            "last_username" => $lastUsername,
            "error" => $error
        ]);
    }
}