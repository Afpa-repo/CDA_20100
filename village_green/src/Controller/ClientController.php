<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/client")
 */
class ClientController extends AbstractController
{
    /**
     * @Route("/", name="client_index", methods={"GET"})
     */
    public function index(): Response
    {
        $clients = $this->getDoctrine()
            ->getRepository(Client::class)
            ->findAll();

        return $this->render('client/index.html.twig', [
            'clients' => $clients,
        ]);
    }

    /**
     * @Route("/new", name="client_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $client->setCliRegl('A définir');
            $client->setCliCateg('A définir');
            $client->setCliCoeff('1');
            $client->setCliRole('utilisateur');
            $client->setCliPassword(
                $passwordEncoder->encodePassword(
                    $client,
                    $form->get('cliPassword')->getData()
                )
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            // Message de validation de l'inscription
            $this->addFlash(
                'success',
                'Votre inscription est validée !!'
            );

            // Et nous redirigeons vers la page d'accueil
            return $this->redirectToRoute('home');
        }

        return $this->render('client/new.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{cliId}", name="client_show", methods={"GET"})
     */
    public function show(Client $client): Response
    {
        return $this->render('client/show.html.twig', [
            'client' => $client,
        ]);
    }

    /**
     * @Route("/{cliId}/edit", name="client_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Client $client): Response
    {
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        $recup_password = $client->getCliPassword();

        if ($form->isSubmitted() && $form->isValid()) {
            
            if(empty($form->get('cliPassword')->getData()))
            {
                $recup_password = $client->getCliPassword();
                $client->setCliPassword($recup_password);
            }
            
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Modification du profil validée'
            );

            return $this->redirectToRoute('home');
        }

        return $this->render('client/edit.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
            'recup' => $recup_password,
        ]);
    }

    /**
     * @Route("/{cliId}", name="client_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Client $client): Response
    {
        if ($this->isCsrfTokenValid('delete'.$client->getCliId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($client);
            $entityManager->flush();
        }

        // Message de succès de suppression du compte
        $this->addFlash(
            'success',
            'Profil supprimé avec succès !!'
        );

        return $this->redirectToRoute('home');
    }
}
