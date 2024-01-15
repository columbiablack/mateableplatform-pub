<?php

/**
 * Copyright (c) 2024 Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\http\Request;
use mateable\core\Platform;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */

class SiteController extends Controller
{
    public function download(): string
    {
        return $this->render('download');
    }

    public function contact(Request $request): string
    {
        $contact = new ContactForm();

        if($request->is_Post())
        {
            if($contact->validate() && $contact->contactUs())
            {

                return $this->render('contact', ['model' => $contact]);
            }
        }
        return $this->render('contact', ['model' => $contact]);
    }

    public function home(): string
    {
        return Platform::$app->view->renderView('home');
    }

    public function aboutUs(): string
    {
        return $this->render('aboutus');
    }

}