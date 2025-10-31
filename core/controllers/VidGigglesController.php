<?php

/**
 * Copyright (c) 2025. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\Platform;
use mateable\core\routes\Routes;
use mateable\core\models\VidGigglesModel;
use mateable\core\middlewares\AuthMiddleware;

class VidGigglesController extends Controller
{
    /**
     * Objects
     */
    private array $vidGigglesList;
    private VidGigglesModel $contentModel;

    /**
     * Page presets
     */
    private int $page = 1;              // Current Page
    private int $vidPerPage = 12;       // How many videos per page
    private int $totalVids = 0;         // Total videos in list
    private int $totalPages = 0;

    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(Routes::authAllowedRoutes()));
    }

    public function checkDB(VidGigglesModel $vidGigglesModel): bool
    {
        if($vidGigglesModel::getDatabase() === Platform::$app->dbVG){
            return true;
        }else{
            return false;
        }
    }

    private function calculatePagination(): void
    {
        $this->totalVids = count($this->vidGigglesList);
        $this->totalPages = (int)ceil($this->totalVids / $this->vidPerPage);
    }

    public function vidGiggles(): string
    {
        // Register DB model
        Platform::$app->vidGigglesContent = new VidGigglesModel();
        Platform::$app->vidGigglesContent::setDatabase(Platform::$app->dbVG);

        // Get query parameters
        $this->page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $searchQuery = $_GET['search'] ?? '';

        // Fetch paginated results
        $vidGigglesList = $this->search($searchQuery);
        $this->contentModel = new VidGigglesModel();
        $this->contentModel::setDatabase(Platform::$app->dbVG);

        if(isset($_GET['video_id'])) {
            foreach($vidGigglesList as $this->contentModel){
                if($this->contentModel->v == $_GET['video_id']) {
                    Platform::$app->vidGigglesContent = $this->contentModel;
                    break;
                }
            }
        }

        return $this->renderView('profile/vidGigglesEngine/vidGiggles', [
            "vidGigglesList" => $vidGigglesList,
            "contentModel" => $this->contentModel,
            "page" => $this->page,
            "totalPages" => $this->totalPages,
            "search" => $searchQuery,
        ]);
    }

    public function vidFetch(): string
    {
        //header('Content-Type: application/json');

        $this->page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        //$searchQuery = $_GET['search'] ?? '';

        if(!$this->checkDB(Platform::$app->vidGigglesContent)) {
            Platform::$app->vidGigglesContent::setDatabase(Platform::$app->dbVG);
        }

        //$this-> vidGigglesList = $this->search($searchQuery);

        return $this->renderView('profile/vidGigglesEngine/vidGiggles', [
            "vidGigglesList" => $this->vidGigglesList,
            "page" => $this->page,
            "totalPages" => $this->totalPages,
        ]);

    }

    public function getVisibleVideos(): array
    {
        $this->calculatePagination();
        $offset = ($this->page - 1) * $this->vidPerPage;
        return array_slice($this->vidGigglesList, $offset, $this->vidPerPage);
    }

    public function nextPage(): string
    {
        if ($this->page < $this->totalPages) {
            $this->page++;
        }
        return $this->renderView('profile/vidGigglesEngine/vidGiggles', [
            "contentModel" => Platform::$app->vidGigglesContent,
            "videos" => $this->getVisibleVideos(),
            "page" => $this->page,
            "totalPages" => $this->totalPages,
        ]);
    }

    public function previousPage(): string
    {
        if ($this->page > 1) {
            $this->page--;
        }
        return $this->renderView('profile/vidGigglesEngine/vidGiggles', [
            "contentModel" => Platform::$app->vidGigglesContent,
            "videos" => $this->getVisibleVideos(),
            "page" => $this->page,
            "totalPages" => $this->totalPages,
        ]);
    }

    public function populateList(string $query): array
    {
        $model = Platform::$app->vidGigglesContent;

        if(!$this->checkDB($model)) {
            $model::setDatabase(Platform::$app->dbVG);
        }

        $offset = ($this->page - 1) * $this->vidPerPage;

        $this->totalVids = $model::countAll(["title" => $query, "description" => $query]);
        $this->totalPages = (int)ceil($this->totalVids / $this->vidPerPage);

        $this->vidGigglesList = $model::findAllVid(["title" => $query, "description" => $query], $this->vidPerPage, $offset);
        return $this->vidGigglesList;
    }

    public function search(string $query): array
    {
        $model = Platform::$app->vidGigglesContent;

        if(!$this->checkDB($model)) {
            $model::setDatabase(Platform::$app->dbVG);
        }

        $offset = ($this->page - 1) * $this->vidPerPage;

        $this->totalVids = $model::countAll([
            "category" => $query,
            "description" => $query,
            "title" => $query
        ]);

        $this->totalPages = (int)ceil($this->totalVids / $this->vidPerPage);

        $this->vidGigglesList = $model::findAllVid([
            "category" => $query,
            "description" => $query,
            "title" => $query
        ], $this->vidPerPage, $offset);

        return $this->vidGigglesList;
    }

}