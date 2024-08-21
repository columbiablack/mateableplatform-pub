<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\routes;

use mateable\core\controllers\AuthController;
use mateable\core\controllers\MessageController;
use mateable\core\controllers\SiteController;
use mateable\core\controllers\WalletController;
use mateable\core\Platform;

class Routes
{
    public static function authAllowedRoutes(): array
    {
        return [
            'dashboard',
            'walletmanager',
        ];
    }

    public static function getAllowedRoutes(): array
    {
        return ['get' => [
            '/login' => [AuthController::class, 'login'],
            '/messages' => [MessageController::class, 'chat'],
            '/register' => [AuthController::class, 'register'],
            '/dashboard' => [AuthController::class, 'dashboard'],
            '/' => [SiteController::class, 'home'],
            '/home' => [SiteController::class, 'home'],
            '/about-us' => [SiteController::class, 'aboutUs'],
            '/contactus' => [SiteController::class, 'contact'],
            '/downloads' => [SiteController::class, 'downloads'],
            '/marketplace' => [SiteController::class, 'marketplace'],
            '/legal' => [SiteController::class, 'legal'],
            '/verify-us' => [SiteController::class, 'verifyUs'],
            '/webmigrate' => [SiteController::class, 'webMigrate'],
            '/logout' => [SiteController::class, 'logout'],
            '/walletmanager' => [WalletController::class, 'walletmanager'],
            '/walletmanager/transactions' => [WalletController::class, 'loadTransactionHistory'],
            '/show/{id}' => function($id) {
                return "<p>id: $id</p>";
            },
            ]
        ];
    }

    public static function postAllowedRoutes(): array
    {
        $routesPOST['post'] = [
            '/login' => [AuthController::class, 'login'],
            '/register' => [AuthController::class, 'register'],
            '/register#register' => [AuthController::class, 'register'],
            '/contactus' => [SiteController::class, 'contact'],
            '/verify-us' => [SiteController::class, 'verifyUs'],
            '/walletmgr/dispose' => [WalletController::class, 'walletRemove'],
            '/walletmgr/n/address' => [WalletController::class, 'createNewAddress'],
            '/walletmgr/n/wallet' => [WalletController::class, 'createNewWallet'],
        ];
        return $routesPOST;
    }
}