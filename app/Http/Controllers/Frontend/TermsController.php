<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\PageService;
use Gmopx\LaravelOWM\LaravelOWM;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    /**
     * The weather service instance.
     *
     * @var $weatherService
     */
    protected $weatherService;
    /**
     * The page service instance.
     *
     * @var $pageService
     */
    protected $pageService;

    /**
     * Create a new controller instance.
     *
     * @param  PageService $pageService
     *
     */
    public function __construct(PageService $pageService, LaravelOWM $weatherService)
    {
        $this->pageService = $pageService;
        $this->weatherService=$weatherService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('_frontend.terms.terms')->with([
            'terms' => $this->pageService->findById(2),
            'weather' => $this->weatherService->getCurrentWeather($query=['lat'=> 27.5833, 'lon'=> 84.8464], $lang = 'en', $units = 'metric', $cache = false, $time = 600)
        ]);
    }
}
