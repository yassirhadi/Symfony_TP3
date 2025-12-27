<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\CreditCardType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PaymentController extends AbstractController
{
    #[Route('/payment', name: 'app_payment')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(CreditCardType::class);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            
            // Here you would typically process the payment
            // For now, we'll just show a success message
            $this->addFlash('success', 'Payment processed successfully!');
            
            // In a real application, you would redirect to a confirmation page
            return $this->redirectToRoute('app_payment');
        }

        return $this->render('payment/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
