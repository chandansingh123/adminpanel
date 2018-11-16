<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Http\Requests\Product\ProductRequest;
use Yajra\Datatables\Datatables;
use App\Services\ProductService;
use App\Services\ItemService;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\QueryException;
use App\Exceptions\DBTransactionException;

class ProductController extends Controller
{
    /**
     * The product service instance.
     *
     * @var $productService
     */
    protected $productService;

    /**
     * The item service instance.
     *
     * @var $itemService
     */
    protected $itemService;

    /**
     * Create a new controller instance.
     *
     * @param  ProductService $productService
     * @param  ItemService $itemService
     *
     */
    public function __construct(ProductService  $productService, ItemService  $itemService)
    {
        $this->middleware('auth');
        $this->productService = $productService;
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

            $products = Product::with('item')->select(['id', 'name', 'item_id', DB::raw('DATE_FORMAT(delivery_date, "%Y-%m-%d") AS delivery_date'), DB::raw('DATE_FORMAT(closed_date, "%Y-%m-%d") AS closed_date'), 'offer_quantity', 'min_reserved_price', 'status', DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") AS created_at')]);
            return Datatables::of($products)
                ->addColumn('actions', function ($product) {
                    $actions = '  <a href="/product/edit/' . $product->id . '" title="Edit"><i class="fa fa-edit"></i></a>';
                    $actions .= '  <a href="javascript:void(0)" class="product-delete-btn"  data-toggle="modal" data-target="#productDeleteModal" title="Remove"  data-id=' . $product->id . '><i class="fa fa-trash"></i></a>';
                    return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.product.product');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product.product-add')->with([
            'items' => $this->itemService->itemDropdown()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $this->productService->save($request->except(['_method', '_token']));
            \Log::info('Product added successfully.', ["created_by" => \Auth::user()->id]);
            return redirect('/products')->with('message', 'Product added successfully.');

        } catch (ValidationException $e) {
            \Log::error('Failed to save product.', ["ValidationException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (QueryException $e) {
            \Log::error('Failed to save product.', ["QueryException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (DBTransactionException $e) {
            \Log::error('Failed to save product.', ["Transaction" => $e->getMessage()]);
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
        return view('backend.product.product-edit')->with([
            'product' => $this->productService->findById($id),
            'items' => $this->itemService->itemDropdown()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request)
    {
        try {
            $this->productService->update($request->except(['_method', '_token']));
            \Log::info('Product updated successfully.', ["created_by" => \Auth::user()->id]);
            return redirect('/products')->with('message', 'Product updated successfully.');

        } catch (ValidationException $e) {
            \Log::error('Failed to update product.', ["ValidationException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (QueryException $e) {
            \Log::error('Failed to update product.', ["QueryException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (DBTransactionException $e) {
            \Log::error('Failed to save product.', ["Transaction" => $e->getMessage()]);
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
        try {
            $this->productService->destroy($id);
            $response['status'] = \Config::get('constants.SUCCESS');
            $response['message'] = 'Product deleted successfully.';
            \Log::info('Product deleted successfully.', ["deleted_by" => \Auth::user()->id, "id" => $id]);
        } catch (GeneralException $e) {
            $response['status'] = \Config::get('constants.ERROR');
            $response['message'] = 'There was a problem deleting this product. Please try again.';
            \Log::error('Failed to delete product.', ["GeneralException" => $e->getMessage()]);
        }
        return response()->json($response);
    }
}
