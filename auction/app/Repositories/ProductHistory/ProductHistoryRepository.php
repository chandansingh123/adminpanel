<?php

namespace App\Repositories\ProductHistory;

use App\Models\ProductHistory\ProductHistory;
use Illuminate\Support\Facades\DB;

/**
 * Class ProductHistoryRepository
 * @package App\Repositories\ProductHistory
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
class ProductHistoryRepository implements ProductHistoryContract
{
    /**
     * Eloquent ProductHistory Model
     *
     * @var $model
     */
    protected $model;

    /**
     * Create a new product history repository instance.
     *
     * @param ProductHistory $model
     */
    public function __construct(ProductHistory $model)
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
        return $this->model->orderBy($orderBy, $sort)->where('status', \Config::get('constants.ACTIVE_STATUS'))->get($columns);
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
        return $this->model->findOrFail($id, $columns);
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

}