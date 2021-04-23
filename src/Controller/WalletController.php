<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WalletController extends AbstractController
{
    /**
     * @Route("/wallet", name="user_wallet")
     */
    public function wallet() {

        return $this->render('wallet/wallet.html.twig', [
            'admin_email' => $this->getParameter('app.admin_email')
        ]);
    }
}