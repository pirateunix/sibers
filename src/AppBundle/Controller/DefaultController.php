<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Users;
use AppBundle\Helpers\Paginator;
use AppBundle\Services\Md5Encoder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\UserAddType;
use AppBundle\Form\Type\UserType;


class DefaultController extends Controller
{
    /**
     * @Route("/admin/{page}/{sort}", defaults={"page": 1, "sort": "login"}, name="homepage", requirements={
     *  "page": "\d+",
     *  "sort": "login|name|surname"
     *   })
     */
    public function indexAction($page, $sort)
    {

        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Users');

        $paginator = new Paginator($repository, '/admin/', $sort, $page);
        $items = $paginator->getItems();
        $pages = $paginator->getPages();
        return $this->render('AppBundle:Default:index.html.twig', array('users' => $items, 'pages' => $pages));

    }

    /**
     * @Route("/admin/addUser/", name="addUser")
     */
    public function addAction(Request $request)
    {

        $user = new Users();

        $form = $this->createForm(UserAddType::class, $user);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $repository = $this->getDoctrine()->getManager();
                $encoder = new Md5Encoder;
                $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
                $user->setPassword($password);
                $repository->persist($user);
                $repository->flush();
                return $this->redirect('/admin');
            }
        }

        return $this->render('AppBundle:Default:add.html.twig', array('form' => $form->createView()));

    }

    /**
     * @Route("/admin/editUser/{id}", name="editUser")
     */
    public function editAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getManager();
        $user = $repository->getRepository('AppBundle:Users')
            ->findOneById($id);
        if (!$user) {
            throw $this->createNotFoundException('No users found');
        }

        $form = $this->createForm(UserType::class, $user);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $repository->flush();
                return $this->redirect('/admin');
            }
        }

        return $this->render('AppBundle:Default:edit.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/admin/deleteUser/{id}", name="deleteUser")
     */
    public function deleteAction($id)
    {

        $repository = $this->getDoctrine()->getManager();
        $user = $repository->getRepository('AppBundle:Users')
            ->findOneById($id);
        if (!$user) {
            throw $this->createNotFoundException('No users found');
        }
        $repository->remove($user);
        $repository->flush();
        return $this->redirect('/admin');
    }

    /**
     * @Route("/admin/viewUser/{id}", name="viewUser")
     */
    public function viewAction($id)
    {

        $repository = $this->getDoctrine()->getManager();
        $user = $repository->getRepository('AppBundle:Users')
            ->findOneById($id);

        if (!$user) {
            throw $this->createNotFoundException('No users found');
        }

        return $this->render('AppBundle:Default:view.html.twig', array('user' => $user));

    }
}
