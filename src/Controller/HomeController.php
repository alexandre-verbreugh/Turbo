<?php

namespace App\Controller;

use App\Form\MessageType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(MessageType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return new Response(
            $this->renderView('home/message_strame.html.twig', [
                'message' => $form->get('message')->getData()
            ]), 200, [
                'Content-Type' => 'text/vnd.turbo-stream.html'
            ]);
        }

        return $this->render('home/index.html.twig', [
            'form' => $form,
        ]);
    }
}
