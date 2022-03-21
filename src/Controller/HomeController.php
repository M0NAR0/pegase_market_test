<?php

namespace App\Controller;

use App\Entity\CallbackRequest;
use App\Entity\CallSlot;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/form", name="app_form")
     */
    public function callbackRequestFormAction(Request $request): Response
    {
        $callbackRequest = new CallbackRequest();
        // Create form
        $form = $this->createFormBuilder($callbackRequest)
            ->add('lastname', TextType::class, ['label' => 'NOM'])
            ->add('firstname', TextType::class, ['label' => 'Prénom'])
            ->add('email', TextType::class, ['label' => 'Email'])
            ->add('phone', TextType::class, ['label' => 'Téléphone'])
            ->add('callSlot', EntityType::class, ['label' => 'Créneau', 'class' => CallSlot::class])
            ->add('callbackDate', DateType::class, ['label' => 'Date de rappel', 'widget' => 'single_text'])
            ->add('message', TextareaType::class, ['label' => 'Message'])
            ->add('send', SubmitType::class, ['label' => 'Envoyer'])
            ->getForm();
        // Process form
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $callbackRequest = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($callbackRequest);
            $em->flush();

            return $this->render('home/form/success.html.twig');
        }
        else {
            //error
        }

        return $this->render('home/form/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
