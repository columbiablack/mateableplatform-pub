<?php

/**
 * Copyright (c) 2025. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\http\Request;
use mateable\core\models\SearchModel;

class SearchController extends Controller
{
    public function find(Request $request): string
    {
        $searchModel = new SearchModel();

        if ($request->isGet()) {
            $searchModel->loadData($request->getBody());

            $results = $searchModel->search();

            return $this->renderView('search', ['searchModel' => $searchModel, 'results' => $results]);
        }

        return $this->renderView('search', ['searchModel' => new SearchModel(), 'results' => []]);
    }
}
