<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ItemService;
use App\Services\ActivityService;
use App\Services\MemberService;
use App\Services\GalleryService;
use Gmopx\LaravelOWM\LaravelOWM;

class HomeController extends Controller
{
    /**
     * The item service instance.
     *
     * @var $itemService
     */
    protected $itemService;

    /**
     * The activity service instance.
     *
     * @var $activityService
     */
    protected $activityService;

    /**
     * The member service instance.
     *
     * @var $memberService
     */
    protected $memberService;

    /**
     * The gallery service instance.
     *
     * @var $galleryService
     */
    protected $galleryService;

    /**
     * The weather service instance.
     *
     * @var $weatherService
     */
    protected $weatherService;

    /**
     * Create a new controller instance.
     *
     * @param  ItemService $itemService
     * @param  ActivityService $activityService
     * @param  MemberService $memberService
     * @param  GalleryService $galleryService
     * @param  LaravelOWM $weatherService
     */
    public function __construct(ItemService $itemService, ActivityService $activityService, MemberService $memberService, GalleryService $galleryService, LaravelOWM $weatherService)
    {
        $this->itemService = $itemService;
        $this->activityService = $activityService;
        $this->memberService = $memberService;
        $this->galleryService = $galleryService;
        $this->weatherService = $weatherService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('_frontend.home.home')->with([
            'items' => $this->itemService->findAll(),
            'activities' => $this->activityService->findAll(),
            'members' => $this->memberService->findAll(),
            'galleries' => $this->galleryService->findAll(),
            'weather' => $this->weatherService->getCurrentWeather($query=['lat'=> 27.5833, 'lon'=> 84.8464], $lang = 'en', $units = 'metric', $cache = false, $time = 600)
        ]);
        // return view('frontend.home.home')->with([
        //     'items' => $this->itemService->findAll(),
        //     'activities' => $this->activityService->findAll(),
        //     'members' => $this->memberService->findAll(),
        //     'galleries' => $this->galleryService->findAll(),
        //     'weather' => $this->weatherService->getCurrentWeather($query=['lat'=> 27.5833, 'lon'=> 84.8464], $lang = 'en', $units = 'metric', $cache = false, $time = 600)
        // ]);
    }
}
