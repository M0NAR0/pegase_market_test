<?php

namespace App\Controller;

use App\Entity\CallSlot;
use App\Repository\CallbackRequestRepository;
use App\Repository\CallSlotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(): Response
    {
        return $this->redirectToRoute('admin_dashboard');
    }

    /**
     * @Route("/admin/dashboard", name="admin_dashboard")
     */
    public function showDashboardAction(CallbackRequestRepository $callbackRequestRepository): Response
    {
        $lastFiveCR = $callbackRequestRepository->findTheLastFive();
        $todaysCRToTreat = $callbackRequestRepository->findTheOnesToTreatToday();

        return $this->render('admin/dashboard.html.twig', [
            'lastFiveCR' => $lastFiveCR,
            'todaysCRToTreat' => $todaysCRToTreat,
        ]);
    }

    /**
     * @Route("/admin/callbackRequests", name="admin_callback_requests_list")
     */
    public function listCallbackRequestsAction(CallbackRequestRepository $callbackRequestRepository): Response
    {
        $callbackRequests = $callbackRequestRepository->findAll();

        return $this->render('admin/callback_requests/list.html.twig', [
            'callbackRequests' => $callbackRequests,
        ]);
    }

    /**
     * @Route("/admin/callSlots", name="admin_call_slots_list")
     */
    public function listCallSlotsAction(CallSlotRepository $callSlotRepository): Response
    {
        $callSlots = $callSlotRepository->findAll();

        return $this->render('admin/call_slots/list.html.twig', [
            'callSlots' => $callSlots,
        ]);
    }

    /**
     * @Route("/admin/callSlots/create", name="admin_create_callslot")
     */
    public function createCallSlotAction(Request $request): Response
    {
        $callSolt = new CallSlot();
        // Create form
        $form = $this->createFormBuilder($callSolt)
            ->add('label', TextType::class, ['label' => 'Libellé'])
            ->add('startTime', TimeType::class, ['label' => 'Heure de début'])
            ->add('endTime', TimeType::class, ['label' => 'Heure de fin'])
            ->add('send', SubmitType::class, ['label' => 'Envoyer'])
            ->getForm();
        // Process form
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $callSolt = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($callSolt);
            $em->flush();

            return $this->redirectToRoute('admin_call_slots_list');
        }
        else {
            //error
        }

        return $this->render('admin/call_slots/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
