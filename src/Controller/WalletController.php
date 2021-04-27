<?php

namespace App\Controller;
use App\Entity\Wallet;
use App\Form\DepositType;
use App\Repository\WalletRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WalletController extends AbstractController
{
    /**
     * @Route("/wallet", name="user_wallet")
     * @param WalletRepository $walletRepository
     * @return Response
     */
    public function wallet(WalletRepository $walletRepository) : Response {

        $user = $this->getUser();
        $id_user = $user->getId();

        // Deposit form
        $wallet = new Wallet();
        $wallet->setIdUser();
        $form = $this->createForm(DepositType::class, $wallet);

        // User's wallet
        $wallets = $walletRepository
            ->findBy(['id_user' => $id_user]);


        return $this->render('wallet/wallet.html.twig', [
            'wallets' => $wallets,
            'deposit_form' => $form->createView()
        ]);
    }


}