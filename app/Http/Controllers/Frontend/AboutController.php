<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Gmopx\LaravelOWM\LaravelOWM;
use Illuminate\Http\Request;
use App\Services\PageService;

class AboutController extends Controller
{
    /**
     * The page service instance.
     *
     * @var $pageService
     */
    protected $pageService;
    protected $weatherService;

    /**
     * Create a new controller instance.
     *
     * @param  PageService $pageService
     *
     */
    public function __construct(PageService $pageService ,LaravelOWM $weatherService)
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
        return view('_frontend.about.about')->with([
            'about' => $this->pageService->findById(1),
            'weather' => $this->weatherService->getCurrentWeather($query=['lat'=> 27.5833, 'lon'=> 84.8464], $lang = 'en', $units = 'metric', $cache = false, $time = 600)

        ]);
    }
}
