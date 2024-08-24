<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\models\PostModel;

class NewsPostController
{
    private array $postList = [];
    private ?PostModel $post;

    public function getNewsPosts(): array
    {
        $this->postList = (new postModel)::findAll(["id"=> "*"]);
        if($this->postList >= 1){
            return $this->postList;
        }else{
            return [];
        }
    }

    public function uploadNewsPost(): bool
    {
        if($this->post->validate() && $this->post->save()) {
            return true;
        }else{
            return false;
        }
    }

    public function removeNewsPost(): bool
    {
        return $this->post->remove();
    }
}