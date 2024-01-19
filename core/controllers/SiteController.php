<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\http\Request;
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
        return $this->render('about-us');
    }

    public function contact(Request $request): string
    {
        $contact = new ContactForm();

        if($request->isPost())
        {
            $contact->loaddata($request->getBody());

            if($contact->validate() && $contact->contactUs())
            {
                Platform::$app->session->setFlash('success', 'Your message was sent! Responses will vary from 30 minutes to 24 hours.');
                return $this->render('contact', ['model' => (new $contact)]);
            }
        }
        return $this->render('contact', ['model' => $contact]);
    }

    public function downloads(): string
    {
        return $this->render('downloads');
    }

    public function home(): string
    {
        return Platform::$app->view->renderView('home');
    }

    public function marketplace(): string
    {
        return $this->render('marketplace');
    }

    public function legal(): string
    {
        $type = str_replace('type=','',$_SERVER['QUERY_STRING']);
        return match ($type) {
            'privacypolicy' => $this->renderLegal('privacypolicy'),
            'serviceterms' => $this->renderLegal('termsofservice')
        };
    }
}