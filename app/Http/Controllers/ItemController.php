<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item\Item;
use Yajra\Datatables\Datatables;
use App\Services\ItemService;
use App\Http\Requests\Item\ItemRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\QueryException;
use App\Exceptions\DBTransactionException;

class ItemController extends Controller
{
    /**
     * The item service instance.
     *
     * @var $itemService
     */
    protected $itemService;


    /**
     * Create a new controller instance.
     *
     * @param  ItemService $itemService
     *
     */
    public function __construct(ItemService $itemService)
    {
        $this->middleware('auth');
        $this->itemService = $itemService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $items = Item::select(['id', 'name', 'status', 'created_at']);
            return Datatables::of($items)
                ->addColumn('actions', function ($item) {
                    $actions = '  <a href="/item/edit/' . $item->id . '" title="Edit"><i class="fa fa-edit"></i></a>';
                    return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('backend.item.item');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.item.item-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Item\ItemRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $image = null;
        try {
            if ($request->hasFile('file_name')) {
                $image = $request->file('file_name');
            }
            $this->itemService->save($request->only(['name', 'description', 'status']), $image);
            \Log::info('Item added successfully.', ["created_by" => \Auth::user()->id]);
            return redirect('/items')->with('message', 'Item added successfully.');

        } catch (ValidationException $e) {
            \Log::error('Failed to save item.', ["ValidationException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (QueryException $e) {
            \Log::error('Failed to save item.', ["QueryException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (DBTransactionException $e) {
            \Log::error('Failed to save item.', ["Transaction" => $e->getMessage()]);
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
        return view('backend.item.item-edit')->with([
            'item' => $this->itemService->findById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Item\ItemRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request)
    {
        $image = null;
        try {
            if ($request->hasFile('file_name')) {
                $image = $request->file('file_name');
            }
            $this->itemService->update($request->only(['id', 'name', 'description', 'status']), $image);
            \Log::info('Item updated successfully.', ["created_by" => \Auth::user()->id]);
            return redirect('/items')->with('message', 'Item added successfully.');

        } catch (ValidationException $e) {
            \Log::error('Failed to save item.', ["ValidationException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (QueryException $e) {
            \Log::error('Failed to save item.', ["QueryException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (DBTransactionException $e) {
            \Log::error('Failed to save item.', ["Transaction" => $e->getMessage()]);
            return redirect()->back()->with('message', 'There was a problem updating. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //
    }
}
