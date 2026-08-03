<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
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
    public function tournaments(): string
    {
        $upcomingTournaments = [
            [
                'title' => 'Nightfall Cup',
                'game' => 'Arcade Showdown',
                'date' => 'Aug 03 · 8:00 PM',
                'slots' => '24 spots left',
                'description' => 'Fast-paced bracket play for players who love clutch finishes and bold plays.'
            ],
            [
                'title' => 'Rift Arena',
                'game' => 'Strategy Clash',
                'date' => 'Aug 10 · 7:30 PM',
                'slots' => '16 spots left',
                'description' => 'A tactical event for squads that thrive on planning, timing, and coordination.'
            ],
            [
                'title' => 'Pulse Invitational',
                'game' => 'Skill Sprint',
                'date' => 'Aug 17 · 9:00 PM',
                'slots' => '12 spots left',
                'description' => 'A community favorite built for high-energy, high-skill matches.'
            ],
        ];

        $recentResults = [
            ['name' => 'Rin', 'result' => 'Won Nightfall Cup', 'game' => 'Arcade Showdown'],
            ['name' => 'Mika', 'result' => 'Top 4 in Rift Arena', 'game' => 'Strategy Clash'],
            ['name' => 'Jace', 'result' => 'Claimed Pulse Invitational', 'game' => 'Skill Sprint'],
        ];

        return $this->renderView('tournaments', [
            'upcomingTournamentsc' => $upcomingTournaments,
            'recentResultsc' => $recentResults,
        ]);
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