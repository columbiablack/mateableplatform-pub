<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\http\Request;
use mateable\core\messaging\mail\Mailer;
use mateable\core\models\ContactForm;
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
                return $this->renderView('contact', ['model' => (new $contact)]);
            }
        }
        return $this->renderView('contact', ['model' => $contact]);
    }

    public function downloads(): string
    {
        return $this->renderView('downloads');
    }

    public function home(): string
    {
        return $this->renderView('home');
    }

    public function marketplace(): string
    {
        return $this->renderView('marketplace');
    }

    public function legal(): string
    {
        $type = str_replace('type=','',$_SERVER['QUERY_STRING']);
        return match ($type) {
            'privacypolicy' => $this->renderLegal('privacypolicy'),
            'serviceterms' => $this->renderLegal('termsofservice')
        };
    }

    public function webMigrate()
    {
        return include(Platform::$ROOT_DIR.'/Migrations.php');
    }

    public function verifyUs(): string
    {
        return $this->renderView('verification');
    }

    public function logout()
    {
        if(Platform::$app->logout()){
            Platform::$app->response->redirect('/home');
        };
    }
}