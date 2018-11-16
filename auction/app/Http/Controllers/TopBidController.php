<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TopBid\TopBid;
use Yajra\Datatables\Datatables;
use App\Services\TopBidService;
use App\Http\Requests\TopBid\TopBidRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\QueryException;
use App\Exceptions\DBTransactionException;

class TopBidController extends Controller
{
    /**
     * The top bid service instance.
     *
     * @var $topBidService
     */
    protected $topBidService;


    /**
     * Create a new controller instance.
     *
     * @param  TopBidService $topBidService
     *
     */
    public function __construct(TopBidService $topBidService)
    {
        $this->middleware('auth');
        $this->topBidService = $topBidService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $bids = TopBid::select([ 'id', 'name', 'quantity', 'price', 'status', 'created_at']);
            return Datatables::of($bids)
                ->addColumn('actions', function ($bid) {
                    $actions = '  <a href="/top-bid/edit/' . $bid->id . '" title="Edit"><i class="fa fa-edit"></i></a>';
                    $actions .= '  <a href="javascript:void(0)" class="bid-delete-btn"  data-toggle="modal" data-target="#bidDeleteModal" title="Remove"  data-id=' . $bid->id . '><i class="fa fa-trash"></i></a>';
                    return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.top-bid.top-bid');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.top-bid.top-bid-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TopBid\TopBidRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopBidRequest $request)
    {
        try {

            $this->topBidService->save($request->only(['name', 'quantity', 'price', 'status']));
            \Log::info('Bid added successfully.', ["created_by" => \Auth::user()->id, "name" => $request->only('name')]);
            return redirect('/top-bids')->with('message', 'Bid added successfully.');

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.top-bid.top-bid-edit')->with([
            'bid' => $this->topBidService->findById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TopBid\TopBidRequest $request
     * s
     * @return \Illuminate\Http\Response
     */
    public function update(TopBidRequest $request)
    {
        try {
            $this->topBidService->update($request->only(['id', 'name', 'quantity', 'price', 'status']));
            \Log::info('Bid updated successfully.', ["created_by" => \Auth::user()->id, "name" => $request->only('name')]);
            return redirect('/top-bids')->with('message', 'Bid updated successfully.');

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->topBidService->destroy($id);
            $response['status'] = \Config::get('constants.SUCCESS');
            $response['message'] = 'Bid deleted successfully.';
            \Log::info('Bid deleted successfully.', ["deleted_by" => \Auth::user()->id, "id" => $id]);
        } catch (GeneralException $e) {
            $response['status'] = \Config::get('constants.ERROR');
            $response['message'] = 'There was a problem deleting this bid. Please try again.';
            \Log::error('Failed to delete bid.', ["GeneralException" => $e->getMessage()]);
        }
        return response()->json($response);
    }
}