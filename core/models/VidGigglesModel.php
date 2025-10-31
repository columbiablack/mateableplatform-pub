<?php

/**
 * Copyright (c) 2025. Mateable LLC
 */

namespace mateable\core\models;

class VidGigglesModel extends DB

{
    public int $id;
    public int $views;
    public int $total_votes;
    public string $video_id = '';
    public string $title = '';
    public string $thumbnail = '';
    public string $category = '';
    public string $description = '';
    public string $added_on = '';
    public string $average_rating = '';

    public static function tableName(): string
    {
        return 'videos';
    }

    public function attributes(): array
    {
        return [
            'id',
            'video_id',
            'title',
            'thumbnail',
            'category',
            'description',
            'added_on',
            'views',
            'average_rating',
            'total_votes',
        ];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getViews(): int
    {
        return $this->views;
    }

    /**
     * @return int
     */
    public function getTotalVotes(): int
    {
        return $this->total_votes;
    }

    /**
     * @return string
     */
    public function getVideoId(): string
    {
        return $this->video_id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getAddedOn(): string
    {
        return $this->added_on;
    }

    /**
     * @return string
     */
    public function getAverageRating(): string
    {
        return $this->average_rating;
    }

}