<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\Platform;
use mateable\core\http\Request;
use mateable\core\http\Response;
use mateable\core\models\Wallet;
use mateable\core\routes\Routes;
use mateable\core\middlewares\AuthMiddleware;
use mateable\core\exceptions\InternalErrorException;

class WalletController extends Controller
{
    public ?Wallet $wallet;
    public array $walletList = [];
    private array $transactionsList;
    private string $address;
    private string $createWalletResponse;

    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(Routes::authAllowedRoutes()));
    }

    public function loadAddressList(): void
    {
        $this->walletList = (new Wallet)::findAll(["user_id" => Platform::$app->user->displayUserID(), "user_email" => Platform::$app->user->displayEmail()]);

        if(count($this->walletList) >= 1){
            Platform::$app->userWallet = $this->walletlist[0];
        }
    }

    public function loadTransactionHistory()
    {
        $listTransactions = Platform::$app->mateablecoin->listtransactions("*", 100, 0, false);

        if(count($listTransactions) <= 0){
            return [];
        }

        $this->transactionsList = []; // Clear transaction list data before use.

        foreach($listTransactions as $transaction){
            if($transaction["category"] && $transaction["category"] == "send"){
                $this->transactionsList = $transaction["send"];
            }
        }

        return $this->renderView('profile/wallet/transactionhistory', ['historyList' => $this->transactionsList]);
    }

    public function createNewWallet(): string
    {
        $this->createWalletResponse = Platform::$app->mateablecoin->createwallet(Platform::$app->user->displayEmail(), false, false, "", false, false, true); //getnewaddress(Platform::$app->user->displayEmail);
        $this->address = Platform::$app->mateablecoin->getnewaddress();

        if (Platform::$app->mateablecoin->status == 200) {
            $walletModel = new Wallet();
            $walletModel->user_email = Platform::$app->user->email;
            $walletModel->user_id = Platform::$app->user->id;
            $walletModel->address = $this->address;

            if ($walletModel->save()) {
                Platform::$app->session->setFlash('success', 'You have created a new wallet address!');
            } else {
                Platform::$app->session->setFlash('warning', 'You did not create a new wallet address!');
            }
        }else{
            throw new InternalErrorException("There was an internal problem with the Mateablecoin (MTBC) server");
        }

        return $this->renderView('profile/wallet/wallet',['wallet_list' => $this->walletList]);
    }

    public function createNewAddress(): string
    {
        $this->address = Platform::$app->mateablecoin->getnewaddress(Platform::$app->user->displayEmail);

        if (Platform::$app->mateablecoin->status == 200) {
            $walletModel = new Wallet();
            $walletModel->user_email = Platform::$app->user->email;
            $walletModel->user_id = Platform::$app->user->id;
            $walletModel->address = $this->address;

            if ($walletModel->save()) {
                Platform::$app->session->setFlash('success', 'You have created a new address!');
            } else {
                Platform::$app->session->setFlash('warning', 'You did not create a new address!');
            }
        }else{
            throw new InternalErrorException("There was an internal problem with the Mateablecoin (MTBC) server");
        }

        return $this->renderView('profile/wallet/wallet',['wallet_list' => $this->walletList]);
    }

    public function walletmanager(): string
    {
        $this->loadAddressList();
        return $this->renderView('profile/wallet/wallet',['wallet_list' => $this->walletList]);
    }

    public function walletRemove(Request $request, Response $response): string
    {
        $tmpWallet = new Wallet();
        if($request->isPost())
        {
            $tmpWallet->loadData($request->getBody());

            if($tmpWallet->validate()){
                //Platform::$app->session->setFlash('success','You have signed in successfully!!!');
                //$tmpWallet->removeWallet();
                return "It works, this Wallet ID is #$tmpWallet->id..";
            }
        }
        return $this->renderView('profile/wallet/wallet', ['wallet_list' => $this->walletList]);
    }

    public function walletExist(int $id): bool
    {
        $result = false;

        foreach($this->walletList as $walletListItem){
            $this->wallet = $walletListItem;
            if($this->wallet->id == $id){
                $result = true;
            }else{
                $result = false;
            }
        }
        return $result;
    }
}