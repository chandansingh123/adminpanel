<?php

namespace App\Http\Controllers\Frontend;

use App\Exceptions\DBTransactionException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bid\BidRequest;
use App\Http\Requests\Bid\BidUpdateRequest;
use App\Models\Bid\Bid;
use App\Services\ActivityService;
use App\Services\BidService;
use App\Services\MemberService;
use App\Services\ProductService;
use Auth;
use Gmopx\LaravelOWM\LaravelOWM;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class BidController extends Controller
{
    /**
     * The product service instance.
     *
     * @var $productService
     */
    protected $productService;

    /**
     * The bid service instance.
     *
     * @var $bidService
     */
    protected $bidService;

    /**
     * The weather service instance.
     *
     * @var $weatherService
     */
    protected $weatherService;

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

    public function __construct(BidService $bidService, ProductService $productService ,LaravelOWM $weatherService, ActivityService $activityService, MemberService $memberService)
    {
        if (!$this->middleware('auth:web')) {
            return redirect('/login');
        }

        $this->productService = $productService;
        $this->bidService = $bidService;
        $this->weatherService=$weatherService;
        $this->activityService = $activityService;
        $this->memberService = $memberService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return view('_frontend.bid.bidnow')->with([
            'products' => $this->productService->findByItemId($id),
            'activities' => $this->activityService->findAll(),
            'members' => $this->memberService->findAll(),
            'weather' => $this->weatherService->getCurrentWeather($query=['lat'=> 27.5833, 'lon'=> 84.8464], $lang = 'en', $units = 'metric', $cache = false, $time = 600)
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Bid\BidRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BidRequest $request)
    {
        try {
            $this->bidService->save($request->only(['product_id', 'customer_id', 'bid_price', 'bid_quantity']));
            \Log::info('Bid added successfully.', ["created_by" => \Auth::user()->id]);
            return redirect()->back()->with('message', 'Bid added successfully. Awaiting approval from administrator.');

        } catch (ValidationException $e) {
            \Log::error('Failed to save bid.', ["ValidationException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (QueryException $e) {
            \Log::error('Failed to save bid.', ["QueryException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (DBTransactionException $e) {
            \Log::error('Failed to save bid.', ["Transaction" => $e->getMessage()]);
            return redirect()->back()->with('message', 'There was a problem saving. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bid = $this->bidService->findById($id);
        if ( (Auth::user()->id === $bid->customer_id) && $bid->status != 3 &&  $bid->product->closed_date >= date("Y-m-d H:i:s")  ) {

            return view('_frontend.bid.bid-edit')->with([
                'bid' => $bid,
                'weather' => $this->weatherService->getCurrentWeather($query=['lat'=> 27.5833, 'lon'=> 84.8464], $lang = 'en', $units = 'metric', $cache = false, $time = 600)
            ]);

        }else{
            return redirect('mybids');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function amend(Request $request)
    {
        try {
            $this->bidService->amend($request->only(['id', 'product_id', 'customer_id', 'bid_price', 'bid_quantity', 'status']));
            \Log::info('Bid updated successfully.', ["updated_by" => \Auth::user()->id]);
            return redirect('/mybids')->with('message', 'Bid updated successfully.');

        } catch (ValidationException $e) {
            \Log::error('Failed to update bid.', ["ValidationException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (QueryException $e) {
            \Log::error('Failed to update bid.', ["QueryException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (DBTransactionException $e) {
            \Log::error('Failed to update bid.', ["Transaction" => $e->getMessage()]);
            return redirect()->back()->with('message', 'There was a problem updating. Please try again.');
        }
    }

    /**
     *
     * @param Request $request
     * @return mixed
     */
    public function priceValidation(Request $request)
    {
        if ($request->ajax()) {
            try {
                return $this->productService->isLessThanMinPrice($request->input('bid_price'), $request->input('id'));
            } catch (ValidationException $ex) {
                return 'false';
            }
        }
    }

    /**
     *
     * @param Request $request
     * @return mixed
     */
    public function qtyValidation(Request $request)
    {
        if ($request->ajax()) {
            try {
                return $this->productService->isGreaterThanTotalOffer($request->input('bid_quantity'), $request->input('id'));
            } catch (ValidationException $ex) {
                return 'false';
            }
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mybid()
    {

        return view('_frontend.bid.mybid')->with([
            'bids' => $this->bidService->findBidsByCustomer(),
        ]);
    }

    /**
     * Cancel the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        try {
            $this->bidService->cancel($id);
            $response['status'] = \Config::get('constants.SUCCESS');
            $response['message'] = 'Bid cancelled successfully.';
            \Log::info('Bid cancelled successfully.', ["cancelled_by" => \Auth::user()->id, "id" => $id]);
        } catch (GeneralException $e) {
            $response['status'] = \Config::get('constants.ERROR');
            $response['message'] = 'There was a problem cancelling this image. Please try again.';
            \Log::error('Failed to cancel bid.', ["GeneralException" => $e->getMessage()]);
        }
        return response()->json($response);
    }
}