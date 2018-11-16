<?php

namespace App\Services;

use App\Mail\BidCancel;
use App\Mail\BidConfirmation;
use App\Mail\BidPost;
use App\Repositories\Bid\BidContract;
use App\Repositories\BidHistory\BidHistoryContract;
use App\Repositories\Product\ProductContract;
use App\Repositories\ProductClearingPrice\ProductClearingPriceContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Exceptions\DBTransactionException;
use App\Models\Product\Product;
use Illuminate\Support\Facades\Mail;

/**
 * Class BidService
 * @package App\Services
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
class BidService
{

    /**
     * @var BidContract
     */
    protected $bids;

    /**
     * @var BidHistoryContract
     */
    protected $bidHistories;

    /**
     * @var ProductContract
     */
    protected $products;

    /**
     * @var ProductClearingPriceContract
     */
    protected $productClearingPrice;

    /**
     * Create a new bid repository instance.
     *
     * @param BidContract $bids
     * @param BidHistoryContract $bidHistories
     * @param ProductContract $products
     * @param ProductClearingPriceContract $productClearingPrice
     *
     */
    public function __construct(BidContract $bids, BidHistoryContract $bidHistories, ProductContract $products, ProductClearingPriceContract $productClearingPrice)
    {
        $this->bids = $bids;
        $this->bidHistories = $bidHistories;
        $this->products = $products;
        $this->productClearingPrice = $productClearingPrice;
    }

    /**
     * Find data by id
     *
     * @param       $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById($id)
    {
        return $this->bids->find($id);
    }

    /**
     * Retrieve all data of repository
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        return $this->bids->all();
    }

    /**
     * Count the number of specified model records in the database
     *
     * @return int
     */
    public function count()
    {
        return $this->bids->count();
    }

    /**
     * Save a new entity in repository
     *
     * @param array $bid
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws DBTransactionException
     */
    public function save($bid)
    {
        DB::beginTransaction();
        try {
            $bid['total_price'] = ($bid['bid_price']) * ($bid['bid_quantity']);
            $bidModel = $this->bids->create($bid);

            $bidDetail = $this->bids->find($bidModel->id);
            Mail::to($bidDetail->customer->email)->send(new BidPost($bidModel));
            DB::commit();

        } catch (DBTransactionException $e) {
            DB::rollback();
            throw new DBTransactionException();
        }
    }

    /**
     * Update a entity in repository by id
     *
     * @param array $bid
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws DBTransactionException
     */
    public function update($bid)
    {
        DB::beginTransaction();
        try {
            $bid['confirmed_date'] = Carbon::now();
            $this->bids->update($bid, $bid['id']);
            $bidDetail = $this->bids->find($bid['id']);

            if ($bid['status'] == 2) {
                $productRow = $this->products->find($bidDetail['product_id']);
                $productClearingPrice = [];
                $productClearingPrice['product_id'] = $productRow->id;
                $productClearingPrice['clearing_price'] = Product::getClearingPrice($productRow);
                $this->productClearingPrice->create($productClearingPrice);

                Mail::to($bidDetail->customer->email)->send(new BidConfirmation($bidDetail));
            } else {
                Mail::to($bidDetail->customer->email)->send(new BidCancel($bidDetail));
            }

            DB::commit();

        } catch (DBTransactionException $e) {
            DB::rollback();
            throw new DBTransactionException();
        }
    }

    /**
     * Delete a entity in repository by id
     *
     * @param $id
     *
     * @return boolean
     */
    public function destroy($id)
    {
        return $this->bids->delete($id);
    }

    /**
     * Delete a entity in repository by id
     *
     * @return mixed
     */
    public function findBidsByCustomer()
    {
        return $this->bids->findBidsByCustomerId(Auth::id());
    }

    /**
     * Update a entity in repository by id
     *
     * @param array $bid
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws DBTransactionException
     */
    public function amend($bid)
    {
        DB::beginTransaction();
        try {
            $bid['total_price'] = ($bid['bid_price']) * ($bid['bid_quantity']);
            $this->bids->update($bid, $bid['id']);

            $bid['bid_id'] = $bid['id'];
            unset($bid['id']);
            $this->bidHistories->create($bid);

            DB::commit();

        } catch (DBTransactionException $e) {
            DB::rollback();
            throw new DBTransactionException();
        }
    }

    /**
     * Cancel a entity in repository by id
     *
     * @param integer $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws DBTransactionException
     */
    public function cancel($id)
    {
        DB::beginTransaction();
        try {
            $bid['status'] = 3;
            $bid['confirmed_date'] = Carbon::now();
            $this->bids->update($bid, $id);

            DB::commit();

        } catch (DBTransactionException $e) {
            DB::rollback();
            throw new DBTransactionException();
        }
    }

}