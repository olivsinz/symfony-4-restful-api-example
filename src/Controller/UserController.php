<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;

/**
 * Controller used to manage user resource.
 *
 * @Route("/users")
 *
 */
class UserController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/", name="users_index")
     * @Rest\View
     * @SWG\Response(
     *     response=200,
     *     description="List all users"
     * )
     */
    public function index()
    {
        $users = $this->getDoctrine()->getRepository('App\Entity\User')->findAll();
        return $users;
    }

    /**
     * @Rest\Post(
     *     path = "/create",
     *     name = "users_create"
     * )
     * @Rest\View
     * @ParamConverter(
     *     "user",
     *     converter="fos_rest.request_body",
     *     options={
     *         "validator"={ "groups"="Create" }
     *     }
     *)
     * @SWG\Response(
     *     response=201,
     *     description="Create new user"
     * )
     */
    public function create(User $user, ConstraintViolationList $violations)
    {

       // $violations contient toutes les erreurs résultantes de la validation de usert.
       if (count($violations)) {
           return $this->view($violations, Response::HTTP_BAD_REQUEST);
       }

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->view($user, Response::HTTP_CREATED, [
          'Location' => $this->generateUrl('users_show', [
            'id' => $user->getId(), UrlGeneratorInterface::ABSOLUTE_URL
          ])
        ]);
    }

    /**
     * @Rest\Get(
     *     path = "/{id}",
     *     name = "users_show",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View
     * @SWG\Response(
     *     response=202,
     *     description="Show user's details"
     * )
     */
    public function show(User $user)
    {
        return $this->view($user, Response::HTTP_ACCEPTED, [
          'Location' => $this->generateUrl('users_show', [
            'id' => $user->getId(), UrlGeneratorInterface::ABSOLUTE_URL
          ])
        ]);
    }

    /**
     * @Rest\Put(
     *     path = "/{userId}",
     *     name = "users_edit",
     *     requirements = {"userId"="\d+"}
     * )
     * @Rest\View
     * @ParamConverter(
     *     "user",
     *     converter="fos_rest.request_body",
     *     options={
     *         "validator"={ "groups"="Create" }
     *     }
     *)
     */
    public function edit(User $user, ConstraintViolationList $violations, Request $request)
    {
        // $violations contient toutes les erreurs résultantes de la validation de usert.
        if (count($violations)) {
            return $this->view($violations, Response::HTTP_BAD_REQUEST);
        }

        $userToUpdate = $this->getDoctrine()->getRepository('App\Entity\User')->find($request->get('userId'));
        if (null === $userToUpdate) {
           return $this->view("Specified user not found", Response::HTTP_NOT_FOUND);
        }

        $userToUpdate->setFirstname($user->getFirstname());
        $userToUpdate->setLastname($user->getLastname());

        $em = $this->getDoctrine()->getManager();
        $em->persist($userToUpdate);
        $em->flush();

        return $this->view($userToUpdate, Response::HTTP_ACCEPTED, [
          'Location' => $this->generateUrl('users_show', ['id' => $userToUpdate->getId(), UrlGeneratorInterface::ABSOLUTE_URL])
        ]);
    }

    /**
     * @Rest\Delete(
     *     path = "/{id}",
     *     name = "users_delete",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View
     */
    public function delete(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        return $this->view("Specified user deleted", Response::HTTP_ACCEPTED);
    }
}
