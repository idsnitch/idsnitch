<?php

namespace AppBundle\Controller\Security;

use AppBundle\Entity\Company;
use AppBundle\Entity\KncCorporate;
use AppBundle\Entity\User;
use AppBundle\Form\AdministratorRegistrationForm;
use AppBundle\Form\CompanyCodeFormType;
use AppBundle\Form\LoginForm;
use AppBundle\Form\SubscriptionForm;
use AppBundle\Form\UserRegistrationForm;
use ReCaptcha\ReCaptcha;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @Route("login/admin",name="security-login")
     *
     */
    public function loginAdminAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginForm::class,[
            '_username' => $lastUsername
        ]);

        return $this->render(
            'login.htm.twig',
            array(
                'loginForm' => $form->createView(),
                'error' => $error,
            ));

    }

    public function loginAction(){
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginForm::class,[
            '_username' => $lastUsername
        ]);

        return $this->render(
            'user/login.htm.twig',
            array(
                'loginForm' => $form->createView(),
                'error' => $error,
            ));

    }

    /**
     * @Route("/logout",name="security_logout")
     */
    public function logoutAction(){
        throw new \Exception('This should not be reached');
    }

}
