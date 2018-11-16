<?php

namespace App\Services;

use App\Repositories\Product\ProductContract;
use App\Repositories\ProductHistory\ProductHistoryContract;
use App\Repositories\ProductClearingPrice\ProductClearingPriceContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Image;
use App\Exceptions\DBTransactionException;
use App\Models\Product\Product;

/**
 * Class ProductService
 * @package App\Services
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
class ProductService
{

    /**
     * @var ProductContract
     */
    protected $products;

    /**
     * @var ProductHistoryContract
     */
    protected $productsHistories;

    /**
     * @var ProductClearingPriceContract
     */
    protected $productClearingPrice;


    /**
     * Create a new project repository instance.
     *
     * @param ProductContract $products
     * @param ProductHistoryContract $productsHistories
     * @param ProductClearingPriceContract $productClearingPrice
     *
     */
    public function __construct(ProductContract $products, ProductHistoryContract $productsHistories, ProductClearingPriceContract $productClearingPrice)
    {
        $this->products = $products;
        $this->productsHistories = $productsHistories;
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
        return $this->products->find($id);
    }

    /**
     * Retrieve all data of repository
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        return $this->products->all();
    }

    /**
     * Count the number of specified model records in the database
     *
     * @return int
     */
    public function count()
    {
        return $this->products->count();
    }

    /**
     * Save a new entity in repository
     *
     * @param array $product
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws DBTransactionException
     */
    public function save($product)
    {

        DB::beginTransaction();
        try {
            $product['status'] = ((array_key_exists('status', $product) && $product['status'] == 'on') ? \Config::get('constants.ACTIVE_STATUS') : \Config::get('constants.INACTIVE_STATUS'));
            $productRow = $this->products->create($product);

            $productClearingPrice = [];
            $productClearingPrice['product_id'] = $productRow->id;
            $productClearingPrice['clearing_price'] = Product::getClearingPrice($productRow);
            $this->productClearingPrice->create($productClearingPrice);

            $this->productClearingPrice->create($productClearingPrice);

            $product['product_id'] = $productRow->id;
            $this->productsHistories->create($product);

            DB::commit();

        } catch (DBTransactionException $e) {
            DB::rollback();
            throw new DBTransactionException();
        }
    }

    /**
     * Update a entity in repository by id
     *
     * @param array $product
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws GeneralException
     * @throws DBTransactionException
     */
    public function update($product)
    {
        DB::beginTransaction();
        try {
            $product['status'] = ((array_key_exists('status', $product) && $product['status'] == 'on') ? \Config::get('constants.ACTIVE_STATUS') : \Config::get('constants.INACTIVE_STATUS'));
            $productRow = $this->products->update($product, $product['id']);

            $productClearingPrice = [];
            $productClearingPrice['product_id'] = $productRow->id;
            $productClearingPrice['clearing_price'] = Product::getClearingPrice($productRow);
            $this->productClearingPrice->create($productClearingPrice);

            $product['product_id'] = $productRow->id;
            unset($product['id']);
            $this->productsHistories->create($product);

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
        return $this->products->delete($id);
    }

    /**
     * Retrieve all data of repository by item id
     *
     * @param $id
     *
     * @return boolean
     */
    public function findByItemId($id)
    {
        return $this->products->findByItemId($id);
    }

    /**
     * @param integer $price
     * @param $id
     * @return boolean
     */
    public function isLessThanMinPrice($price, $id)
    {
        $productCount = $this->products->isLessThanMinPrice($price, $id);
        if ($productCount <= 0) {
            return 'true';
        }
        return 'false';
    }

    /**
     * @param integer $qty
     * @param $id
     * @return boolean
     */
    public function isGreaterThanTotalOffer($qty, $id)
    {
        $productCount = $this->products->isGreaterThanTotalOffer($qty, $id);
        if ($productCount <= 0) {
            return 'true';
        }
        return 'false';
    }

    /**
     * project image path
     *
     * @param object $image
     * @param string $fileName
     *
     * @return boolean
     */
    private function uploadPath($image, $fileName)
    {
        $destinationPath = public_path(\Config::get('constants.PRODUCT_IMAGE_PATH'));
        $img = Image::make($image->getRealPath());

        // resize image to fixed size
        $img->resize(500, 400)->save($destinationPath . '/' . $fileName);

        $thumbPath = public_path(\Config::get('constants.PRODUCT_IMAGE_THUMB_PATH'));
        $img->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbPath . '/' . $fileName);
    }

}
