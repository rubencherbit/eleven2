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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Astronaut;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;

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
     *     },
     *     requirements={
     *      {
     *          "name"="astronaut",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="id"
     *      }
     *     }
     * )
     * @Rest\View()
     * @ParamConverter("astronaut", class="AppBundle:Astronaut")
     */
    public function getAction(Astronaut $astronaut)
    {
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
     * @QueryParam(name="offset", requirements="\d+", default=null, description="Index start of request")
     * @QueryParam(name="limit", requirements="\d+", default=null, description="limit number of records")
     */
    public function cgetAction(ParamFetcher $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $limit  = $paramFetcher->get('limit');

        $astronauts = $this->getDoctrine()->getRepository('AppBundle:Astronaut')->findAllAstronauts($offset, $limit);

        if ($astronauts === null || empty($astronauts)) {
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
     *     input="AppBundle\Form\AstronautType",
     *     statusCodes={
     *         201 = "Returned when resource is created",
     *         400 = "Return when bad request"
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

        return new View($astronaut, Response::HTTP_CREATED);
    }
}
