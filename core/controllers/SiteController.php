<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\http\Request;

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
        return $this->render('home');
    }

    public function aboutUs(): string
    {
        return $this->render('aboutus');
    }

}