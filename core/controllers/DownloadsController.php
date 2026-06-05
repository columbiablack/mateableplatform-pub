<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\models\DownloadsModel;

class DownloadsController extends Controller
{
    public array $downloadsList;
    public DownloadsModel $downloadsMdl;

    public function listDownloads():array
    {
        $this->downloadsList = (new DownloadsModel())::findAll(["id" => '*']);
        return $this->downloadsList;
    }

    public function postDownloads(array $listDownload):bool
    {
        foreach($listDownload as $item)
        {
            $this->downloadsMdl = $item;

            if($this->downloadsMdl->validate() && $this->downloadsMdl->upload())
            {
                $this->downloadsMdl->save();

            }
        }
        return true;
    }
}