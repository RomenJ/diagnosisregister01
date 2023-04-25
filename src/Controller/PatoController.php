<?php

namespace App\Controller;

use App\Entity\Pato;
use App\Form\PatoType;
use App\Repository\PatoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pato')]
class PatoController extends AbstractController
{
    #[Route('/', name: 'app_pato_index', methods: ['GET'])]
    public function index(PatoRepository $patoRepository): Response
    {
        return $this->render('pato/index.html.twig', [
            'patos' => $patoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_pato_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PatoRepository $patoRepository): Response
    {
        $pato = new Pato();
        $form = $this->createForm(PatoType::class, $pato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patoRepository->save($pato, true);

            return $this->redirectToRoute('app_pato_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pato/new.html.twig', [
            'pato' => $pato,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pato_show', methods: ['GET'])]
    public function show(Pato $pato): Response
    {
        return $this->render('pato/show.html.twig', [
            'pato' => $pato,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pato_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pato $pato, PatoRepository $patoRepository): Response
    {
        $form = $this->createForm(PatoType::class, $pato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patoRepository->save($pato, true);

            return $this->redirectToRoute('app_pato_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pato/edit.html.twig', [
            'pato' => $pato,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pato_delete', methods: ['POST'])]
    public function delete(Request $request, Pato $pato, PatoRepository $patoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pato->getId(), $request->request->get('_token'))) {
            $patoRepository->remove($pato, true);
        }

        return $this->redirectToRoute('app_pato_index', [], Response::HTTP_SEE_OTHER);
    }
}
