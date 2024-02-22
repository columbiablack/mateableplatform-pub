<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\http\Request;
use mateable\core\middlewares\AuthMiddleware;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }


    public function walletManager(Request $request):string
    {
        $page = $request->getRouteParams['page'] ?? 'nothing';

        return $this->render('/profile/wallet');
    }

}