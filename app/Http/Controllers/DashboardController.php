<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ItemService;
use App\Services\ProductService;
use App\Services\BidService;
use App\Services\CustomerService;

class DashboardController extends Controller
{

    /**
     * The item service instance.
     *
     * @var $itemService
     */
    protected $itemService;

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
     * The customer service instance.
     *
     * @var $customerService
     */
    protected $customerService;

    /**
     * Create a new controller instance.
     *
     * @param  ItemService $itemService
     * @param  ProductService $productService
     * @param  BidService $bidService
     * @param  CustomerService $customerService
     *
     */
    public function __construct(ItemService  $itemService, ProductService  $productService, BidService  $bidService, CustomerService $customerService)
    {
        $this->middleware('auth');
        $this->itemService = $itemService;
        $this->productService = $productService;
        $this->bidService = $bidService;
        $this->customerService = $customerService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.dashboard.dashboard')->with([
            'items' => $this->itemService->count(),
            'products' => $this->productService->count(),
            'customers' => $this->customerService->count(),
            'bids' => $this->bidService->count()
        ]);
    }
}
