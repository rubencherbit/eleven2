<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\AstronautType;

/**
 * Class AstronautController
 * @RouteResource("astronaut")
 */
class AstronautController extends FOSRestController implements ClassResourceInterface
{
    /**
     * Gets an individual Astronaut
     *
     * @param int $id
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @ApiDoc(
     *     output="AppBundle\Entity\Astronaut",
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Return when not found"
     *     }
     * )
     * @Rest\View()
     */
    public function getAction(int $id)
    {
        $astronaut = $this->getDoctrine()->getRepository('AppBundle:Astronaut')->find($id);

        if ($astronaut === null) {
            return new View(null, Response::HTTP_NOT_FOUND);
        }

        return $astronaut;
    }

    /**
     * Gets all Astronauts
     *
     * @param int $id
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @ApiDoc(
     *     output="AppBundle\Entity\Astronaut",
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Return when not found"
     *     }
     * )
     * @Rest\View()
     */
    public function cgetAction()
    {
        $astronauts = $this->getDoctrine()->getRepository('AppBundle:Astronaut')->findAll();

        if ($astronauts === null) {
            return new View(null, Response::HTTP_NOT_FOUND);
        }

        return $astronauts;
    }
    /**
     * Add Astronauts
     *
     * @param int $id
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @ApiDoc(
     *     output="AppBundle\Entity\Astronaut",
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Return when not found"
     *     }
     * )
     * @Rest\View()
     */
    public function postAction(Request $request)
    {
        $form = $this->createForm(AstronautType::class, null, [
        'csrf_protection' => false
        ]);

        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $form;
        }

        $astronaut = $form->getData();

        $em = $this->getDoctrine()->getManager();
        $em->persist($astronaut);
        $em->flush();
        $routeOptions = [
            'id' => $astronaut->getId(),
            '_format' => $request->get('_format'),
        ];
        return null;
    }
}
