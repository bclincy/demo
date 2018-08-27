<?php
/**
 * Created by PhpStorm.
 * User: cherokee
 * Date: 8/27/18
 * Time: 10:28 AM
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;


class SecurityController extends AbstractController
{


    /**
     * @param AuthenticationUtils $authenticationUtils
     *
     * @Route("/login", name="login", methods="GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login (AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));

    }
}
