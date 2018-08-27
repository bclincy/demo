<?php

namespace App\Controller;

use App\Entity\Lead;
use App\Form\LeadType;
use App\Repository\LeadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lead")
 */
class LeadController extends Controller
{
    /**
     * @Route("/", name="lead_index", methods="GET")
     */
    public function index(LeadRepository $leadRepository): Response
    {
        return $this->render('lead/index.html.twig', ['leads' => $leadRepository->findAll()]);
    }


    /**
     * @param Request $request
     *
     * @return Response
     * @Route("/new", name="lead_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $lead = new Lead();
        $form = $this->createForm(LeadType::class, $lead);
//            die('<pre>'. print_r($request->request->get('lead'), true));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lead);
            $em->flush();

            return $this->redirectToRoute('lead_index');
        }

        return $this->render('lead/new.html.twig', [
            'lead' => $lead,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lead_show", methods="GET")
     */
    public function show(Lead $lead): Response
    {
        return $this->render('lead/show.html.twig', ['lead' => $lead]);
    }

    /**
     * @Route("/{id}/edit", name="lead_edit", methods="GET|POST")
     */
    public function edit(Request $request, Lead $lead): Response
    {
        $form = $this->createForm(LeadType::class, $lead);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lead_edit', ['id' => $lead->getId()]);
        }

        return $this->render('lead/edit.html.twig', [
            'lead' => $lead,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request  $request
     * @param Lead $lead
     * @return Response
     * @Route("/{id}", name="lead_delete", methods="DELETE")
     */
    public function delete(Request $request, Lead $lead): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lead->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($lead);
            $em->flush();
        }

        return $this->redirectToRoute('lead_index');
    }

    public function cleanUpName (string $name)
    {
        return trim(ucwords($name));
    }

    public function formatPhone (string $phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        $len = strlen($phone);
        if ($len === 10) {
            $phone = '+'. substr($phone, 0, 1) .
                     substr($phone, 1, 3) . '-' .
                     substr($phone, 3, 3) . '_' .
                     substr($phone, 6, 4);
        } elseif($phone > 10) {
        $countryCode = substr($phone, 0, strlen($phoneNumber)-10);
        $areaCode = substr($phone, -10, 3);
        $nextThree = substr($phone, -7, 3);
        $lastFour = substr($phone, -4, 4);

        $phone = '+'.$countryCode.' ('.$areaCode.') '.$nextThree.'-'.$lastFour;
        } else {

            return false;
        }

        return $phone;
    }
}
