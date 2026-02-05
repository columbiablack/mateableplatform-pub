<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\http\Request;
use mateable\core\models\ContactForm;
use mateable\core\models\UserLoginModel;
use mateable\core\models\UserModel;
use mateable\core\Platform;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */

class SiteController extends Controller
{
    public string $type;

    public function aboutUs(): string
    {
        return $this->renderView('about-us');
    }

    public function contact(Request $request): string
    {
        $contact = new ContactForm();

        if($request->isPost())
        {
            $contact->loaddata($request->getBody());

            if($contact->validate() && $contact->contactUs())
            {
                Platform::$app->session->setFlash('success', 'Your message was sent! Responses will vary from 24 hours to 48 hours.');
            }
        }

        $this->setLayout('auth');
        return $this->renderView('contact', ['model' => $contact]);
    }

    public function home(): string
    {
        return $this->renderView('home');
    }

    public function legal(): string
    {
        $type = str_replace('type=','',$_SERVER['QUERY_STRING']);
        return match ($type) {
            'privacypolicy' => $this->renderLegal('privacypolicy'),
            'serviceterms' => $this->renderLegal('termsofservice')
        };
    }

    public function verifyUs(): string
    {
        return $this->renderView('verification');
    }

    public function logout()
    {
        if(Platform::$app->logout()){
            Platform::$app->session->setFlash('success', "You have successfully signed out!");
            Platform::$app->response->redirect('/home');
        };
    }

    public function show($request): string
    {
        $id = $request->getRouteParams('id');
        // or
        $params = $request->getAllRouteParams();
        $id = $params['id'] ?? null;

        return ($id);
    }

    public function passwordRecovery(Request $request): string
    {
        $this->setLayout('auth');
        return $this->renderview('recovery', ['recModel' => new UserLoginModel()]);
    }
}