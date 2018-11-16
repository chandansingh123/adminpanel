<?php

namespace App\Repositories\Product;

use App\Models\Product\Product;
use Illuminate\Support\Facades\DB;

/**
 * Class ProductRepository
 * @package App\Repositories\Product
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
class ProductRepository implements ProductContract
{
    /**
     * Eloquent Product Model
     *
     * @var $model
     */
    protected $model;

    /**
     * Create a new product repository instance.
     *
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve data array for populate field select
     *
     * @param string $column
     * @param string $key
     *
     * @return \Illuminate\Support\Collection|array
     */
    public function lists($column, $key = null)
    {
        return $this->model->pluck($column, $key)->all();
    }

    /**
     * Count the number of specified model records in the database
     *
     * @return int
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * Retrieve all data of repository
     *
     * @param array $columns
     * @param string $orderBy
     * @param string $sort
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all($columns = ['*'], $orderBy = 'id', $sort = 'asc')
    {
        return $this->model->with(['bids', 'myBids', 'clearingPrice'])->orderBy($orderBy, $sort)->where('status', \Config::get('constants.ACTIVE_STATUS'))->get($columns);
    }

    /**
     * Retrieve all data of repository, paginated
     *
     * @param null $limit
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function paginate($limit = null, $columns = ['*'])
    {
        $limit = is_null($limit) ? 10 : $limit;
        return $this->model->paginate($limit, $columns);
    }

    /**
     * Find data by id
     *
     * @param       $id
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->with(['bids.customer', 'clearingPrice'])->findOrFail($id, $columns);
    }

    /**
     * Find data by field and value
     *
     * @param string $type single|multiple row
     * @param       $field
     * @param       $value
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findByField($type = 'single', $field, $value, $columns = ['*'])
    {
        if ($type === 'single') {
            return $this->model->where($field, '=', $value)->first($columns);
        } else {
            return $this->model->where($field, '=', $value)->get($columns);
        }
    }

    /**
     * Save a new entity in repository
     *
     * @param array $attributes
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes)
    {
        foreach ($attributes as $k => $v) {
            $this->model->$k = $v;
        }
        $this->model->save();
        return $this->model;
        //return $this->model->save();
    }

    /**
     * Update a entity in repository by id
     *
     * @param array $attributes
     * @param       $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(array $attributes, $id)
    {
        $this->model = $this->model->findOrFail($id);
        foreach ($attributes as $k => $v) {
            $this->model->$k = $v;
        }
        $this->model->update();
        return $this->model;
        //return $this->model->update();
    }

    /**
     * Delete a entity in repository by id
     *
     * @param $id
     *
     * @return boolean
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Retrieve  data of repository
     *
     * @param int $id
     * @param array $columns
     * @param string $orderBy
     * @param string $sort
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findByItemId($id, $columns = ['*'], $orderBy = 'id', $sort = 'asc')
    {
        return $this->model->with(['bids', 'myBids', 'clearingPrice'])->orderBy($orderBy, $sort)->where('item_id', $id)->where('status', \Config::get('constants.ACTIVE_STATUS'))->get($columns);
    }

    /**
     * @param $price
     * @param $id
     * @return mixed
     */
    public function isLessThanMinPrice($price, $id)
    {
        $query = $this->model->where('min_reserved_price','>',  $price);
        if (isset($id) && !empty($id)) {
            $query->where('id', $id);
        }
        $result = $query->get()->count();
        return $result;
    }

    /**
     * @param $qty
     * @param $id
     * @return mixed
     */
    public function isGreaterThanTotalOffer($qty, $id)
    {
        $query = $this->model->where('offer_quantity','<',  $qty);
        if (isset($id) && !empty($id)) {
            $query->where('id', $id);
        }
        $result = $query->get()->count();
        return $result;
    }

}