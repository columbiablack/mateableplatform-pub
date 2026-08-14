<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\http\Request;
use mateable\core\models\ContactForm;
use mateable\core\models\TournamentModel;
use mateable\core\models\TournamentEntryModel;
use mateable\core\Platform;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */

class SiteController extends Controller
{
    public string $type;

    /**
     * @return string
     */
    public function aboutUs(): string
    {
        return $this->renderView('about-us');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function contact(Request $request): string
    {
        $contact = new ContactForm();

        if($request->isPost())
        {
            $contact->loaddata($request->getBody());

            if($contact->validate() && $contact->contactUs())
            {
                Platform::$app->session->setFlash('success', 'Your message was sent! Responses will vary from 24 hours to 48 hours.');
            }
        }

        $this->setLayout('auth');
        return $this->renderView('contact', ['model' => $contact]);
    }

    /**
     * @return string
     */
    public function home(): string
    {
        return $this->renderView('home');
    }

    /**
     * @return string
     */
    public function legal(): string
    {
        $type = str_replace('type=','',$_SERVER['QUERY_STRING']);
        return match ($type) {
            'privacypolicy' => $this->renderLegal('privacypolicy'),
            'serviceterms' => $this->renderLegal('termsofservice')
        };
    }

    /**
     * @return string
     */
    public function verifyUs(): string
    {
        return $this->renderView('verification');
    }

    /**
     * @param $request
     * @return string
     */
    public function show($request): string
    {
        $id = $request->getRouteParams('id');
        // or
        $params = $request->getAllRouteParams();
        $id = $params['id'] ?? null;

        return ($id);
    }

    /**
     * @return string
     */
    public function store(): string
    {
        $section = $_GET['section'] ?? 'games';

        return $this->renderView('store', [
            'section' => $section,
            'sectionLabel' => \mateable\core\models\StoreModel::getSectionLabel($section),
            'catalog' => \mateable\core\models\StoreModel::getCatalog($section),
        ]);
    }

    /**
     * @return string
     */
    public function tournaments(Request $request): string
    {
        return $this->renderView('tournaments', [
            'tournaments' => TournamentModel::findAll(
                ['moderation_status' => TournamentModel::MODERATION_APPROVED],
                'starts_at ASC'
            ),
            'newTournament' => new TournamentModel(),
        ]);
    }

    public function createTournament(Request $request): string
    {
        if (Platform::isGuest()) {
            Platform::$app->session->setFlash('warning', 'Sign in before creating a tournament.');
            Platform::$app->response->redirect('/signin');
            return '';
        }

        $tournament = new TournamentModel();
        $tournament->loadData($request->getBody());
        $tournament->creator_id = (int) Platform::$app->user->id;
        $tournament->max_players = max(2, (int) $tournament->max_players);
        $tournament->starts_at = str_replace('T', ' ', $tournament->starts_at);
        $tournament->status = TournamentModel::STATUS_OPEN;
        $tournament->moderation_status = TournamentModel::MODERATION_PENDING;

        if ($tournament->validate() && $tournament->save()) {
            Platform::$app->session->setFlash('success', 'Your tournament was submitted for review.');
        } else {
            Platform::$app->session->setFlash('warning', 'The tournament could not be submitted. Check the form details.');
        }

        Platform::$app->response->redirect('/tournaments');
        return '';
    }

    public function joinTournament(Request $request): string
    {
        if (Platform::isGuest()) {
            Platform::$app->session->setFlash('warning', 'Sign in before joining a tournament.');
            Platform::$app->response->redirect('/signin');
            return '';
        }

        $tournament = TournamentModel::findOne(['id' => (int) ($request->getBody()['id'] ?? 0)]);
        $userId = (int) Platform::$app->user->id;
        $entry = $tournament ? TournamentEntryModel::findOne([
            'tournament_id' => $tournament->id,
            'user_id' => $userId,
        ]) : null;

        if ($tournament && !$entry && $tournament->moderation_status === TournamentModel::MODERATION_APPROVED) {
            $entry = new TournamentEntryModel();
            $entry->tournament_id = $tournament->id;
            $entry->user_id = $userId;

            if ($entry->save()) {
                Platform::$app->session->setFlash('success', 'You are registered for ' . $tournament->title . '.');
            } else {
                Platform::$app->session->setFlash('warning', 'You could not be registered for that tournament.');
            }
        } elseif ($entry) {
            Platform::$app->session->setFlash('warning', 'You are already registered for that tournament.');
        } else {
            Platform::$app->session->setFlash('warning', 'That tournament is not available for registration.');
        }

        Platform::$app->response->redirect('/tournaments');
        return '';
    }

    /**
     * @return string
     */
    public function creatorsStreams(): string
    {
        $featuredCreators = [
            ['name' => 'NovaByte', 'focus' => 'Live strategy guides', 'followers' => '128K followers'],
            ['name' => 'RileyRift', 'focus' => 'Community tournaments', 'followers' => '94K followers'],
            ['name' => 'Kairo Play', 'focus' => 'Competitive highlights', 'followers' => '76K followers'],
        ];

        $liveStreams = [
            ['title' => 'Weekend Bracket Watch', 'host' => 'NovaByte', 'game' => 'Arcade Showdown', 'viewers' => '4.3K watching'],
            ['title' => 'Build Lab Live', 'host' => 'RileyRift', 'game' => 'Strategy Clash', 'viewers' => '1.8K watching'],
            ['title' => 'Speedrun Sprint', 'host' => 'Kairo Play', 'game' => 'Skill Sprint', 'viewers' => '2.1K watching'],
        ];

        return $this->renderView('creators-streams', [
            'featuredCreators' => $featuredCreators,
            'liveStreams' => $liveStreams,
        ]);
    }
}