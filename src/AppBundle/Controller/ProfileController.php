<?php
/**
 * Created by PhpStorm.
 * User: pirate
 * Date: 24.02.16
 * Time: 18:25
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class ProfileController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('AppBundle:Profile:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error' => $error,

            )
        );

    }

    /**
     * @Route("/", name="notAutorize")
     */
    public function indexAction(Request $request)
    {
           return $this->render('AppBundle:Profile:index.html.twig');

    }


}