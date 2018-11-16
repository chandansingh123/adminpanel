<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Gmopx\LaravelOWM\LaravelOWM;
use Illuminate\Http\Request;
use App\Services\CustomerService;
use App\Http\Requests\Customer\CustomerRequest;

class SignupController extends Controller
{
    /**
     * The customer service instance.
     *
     * @var $customerService
     */
    protected $customerService;
    protected  $weatherService;

    /**
     * Create a new controller instance.
     *
     * @param  CustomerService $customerService
     */
    public function __construct(CustomerService $customerService,LaravelOWM $weatherService)
    {
        $this->customerService = $customerService;
        $this->weatherService=$weatherService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('_frontend.signup.signup')->with(['weather' => $this->weatherService->getCurrentWeather($query=['lat'=> 27.5833, 'lon'=> 84.8464], $lang = 'en', $units = 'metric', $cache = false, $time = 600)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Customer\CustomerRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {

        try {
            $this->customerService->save($request->except(['_method', '_token']));
            \Log::info('Customer added successfully.');
            return redirect('/login')->with('message', 'Customer added successfully.');

        } catch (ValidationException $e) {
            \Log::error('Failed to save customer.', ["ValidationException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (QueryException $e) {
            \Log::error('Failed to save customer.', ["QueryException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (DBTransactionException $e) {
            \Log::error('Failed to save customer.', ["Transaction" => $e->getMessage()]);
            return redirect()->back()->with('message', 'There was a problem saving. Please try again.');
        }
    }

    /**
     *
     * @param Request $request
     * @return mixed
     */
    public function availability(Request $request)
    {
        if ($request->ajax()) {
            try {
                return $this->customerService->phoneAvailability($request->input('phone'));
            } catch (ValidationException $ex) {
                return 'false';
            }
        }
    }

}
