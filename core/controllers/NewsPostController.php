<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\http\Request;
use mateable\core\http\Response;
use mateable\core\models\NewsPostModel;
use mateable\core\models\PostModel;

class NewsPostController
{
    private array $postList = [];
    private ?NewsPostModel $newsPost;

    public function getNewsPosts(): array
    {
        $this->postList = (new postModel)::findAll(["id"=> "*"]);
        if($this->postList >= 1){
            ksort($this->postList, );
            return $this->postList;
        }else{
            return [];
        }
    }

    public function uploadNewsPost(): bool
    {
        $newsPost = new NewsPostModel;
        if($newsPost->validate() && $newsPost->save()) {
            return true;
        }else{
            return false;
        }
    }

    public function removeNewsPost(Request $request, Response $response): bool
    {
        return $this->newsPost->remove();
    }

    public function showRecentNews(): string
    {
        $displayText = '';
        if(count($this->postList) >= 1){
            for($i=0; $i <= 10; $i++){
                $this->newsPost = $this->postList[$i];
                $displayText &= '
                <div class="block-heading">
                    <h2 class="text-info">{{'. $this->newsPost->postUserID() .'}} || Date:'. $this->newsPost->postDate() .'</h2>
                </div>
                <div class="block-content">
                    <p>
                        '. $this->newsPost->postContent() .'
                    </p>
                </div>
                 ';
            }
        }

        /**
         * Validate there is text
         * If not then display default
         **/
        If(empty($displayText)){
            $displayText = '
                <div class="block-heading">
                    <h2 class="text-info">No Posts</h2>
                </div>
                <div class="block-content">
                    <p>
                        Unfortunately, there was no current news among us!
                    </p>
                </div>
            ';
        }
        return $displayText;
    }
}