<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid\Bid;
use Yajra\Datatables\Datatables;
use App\Services\BidService;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\QueryException;
use App\Exceptions\DBTransactionException;

class BidController extends Controller
{

    /**
     * The bid service instance.
     *
     * @var $bidService
     */
    protected $bidService;

    /**
     * Create a new controller instance.
     *
     * @param  BidService $bidService
     *
     */
    public function __construct(BidService $bidService)
    {
        $this->middleware('auth');
        $this->bidService = $bidService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $bids = Bid::with('customer')->select([ 'id', 'customer_id', 'bid_quantity', 'bid_price', 'total_price', 'status', 'created_at'])->where('status', 1);
            return Datatables::of($bids)
                ->addColumn('actions', function ($bid) {
                    $actions = '  <a href="javascript:void(0)" class="bid-status-btn"  data-toggle="modal" data-target="#bidStatusModal" title="Change Status"  data-id=' . $bid->id . '><i class="fa fa-exclamation-circle"></i></a>';
                    return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.bid.pending-bid');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmed(Request $request)
    {
        if ($request->ajax()) {

            $bids = Bid::with('customer')->select([ 'id', 'customer_id', 'bid_quantity', 'bid_price', 'total_price', DB::raw('DATE_FORMAT(confirmed_date,"%Y-%m-%d") AS confirmed_date'), 'status', 'created_at'])->where('status', '!=' , 1);
            return Datatables::of($bids)
                ->addColumn('actions', function ($bid) {
                    $actions = '  <a href="/bid/edit/' . $bid->id . '" title="Edit"><i class="fa fa-edit"></i></a>';
                    return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.bid.confirmed-bid');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $this->bidService->update($request->only(['id', 'reason', 'status']));
            \Log::info('Bid updated successfully.', ["created_by" => \Auth::user()->id]);
            $response['status'] = \Config::get('constants.SUCCESS');
            $response['message'] = 'Bid updated successfully.';
        } catch (ValidationException $e) {
            \Log::error('Failed to update bid.', ["ValidationException" => $e->getMessage()]);
            $response['status'] = \Config::get('constants.ERROR');
            $response['message'] = 'There was a problem updating this bid. Please try again.';
        } catch (QueryException $e) {
            \Log::error('Failed to update bid.', ["QueryException" => $e->getMessage()]);
            $response['status'] = \Config::get('constants.ERROR');
            $response['message'] = 'Account code belongs to a different bid. Please try again.';
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}