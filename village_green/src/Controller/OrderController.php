<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Commande;
use App\Form\OrderType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/commande", name="order")
     */
    public function index(Cart $cart, Request $request): Response
    {
        $form=$this->createForm(OrderType::class, null, [
            'user'=>$this->getUser()
        ]);
        return $this->render('order/index.html.twig', [
            'form'=>$form->createView(),
            'cart'=>$cart->getFull()
        ]);
    }

    /**
     * @Route("/commande/recapitulatif", name="order_recap")
     */
    public function add(Cart $cart, Request $request): Response
    {
        $form=$this->createForm(OrderType::class, null, [
            'user'=>$this->getUser()
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $date=new DateTime;
            $adresseFact=$form->get("adresseFact")->getData();
            $adresseLiv=$form->get("adresseLiv")->getData();
            $commande = new Commande();
            $commande->setCmdDate($date);
            $commande->setCmdCliAdresseFact($adresseFact->getAdrNumRue());
            $commande->setCmdCliCpFact($adresseFact->getAdrCp());
            $commande->setCmdCliVilleFact($adresseFact->getAdrVille());
            $commande->setCmdCliAdresseLiv($adresseLiv->getAdrNumRue());
            $commande->setCmdCliCpLiv($adresseLiv->getAdrCp());
            $commande->setCmdCliVilleLiv($adresseLiv->getAdrVille());
        }
        return $this->render('order/add.html.twig', [
            'cart'=>$cart->getFull()
        ]);
    }
}
