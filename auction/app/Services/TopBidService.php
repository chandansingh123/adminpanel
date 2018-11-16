<?php

namespace App\Services;

use App\Repositories\TopBid\TopBidContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Exceptions\DBTransactionException;

/**
 * Class TopBidService
 * @package App\Services
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
class TopBidService
{

    /**
     * @var TopBidContract
     */
    protected $bids;


    /**
     * Create a new bid repository instance.
     *
     * @param TopBidContract $bids
     *
     */
    public function __construct(TopBidContract $bids)
    {
        $this->bids = $bids;
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

            $bid['status'] = ((array_key_exists('status', $bid) && $bid['status'] == 'on') ? \Config::get('constants.ACTIVE_STATUS') : \Config::get('constants.INACTIVE_STATUS'));
            $this->bids->create($bid);

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
     * @throws GeneralException
     * @throws DBTransactionException
     */
    public function update($bid)
    {
        DB::beginTransaction();
        try {
            $bid['status'] = ((array_key_exists('status', $bid) && $bid['status'] == 'on') ? \Config::get('constants.ACTIVE_STATUS') : \Config::get('constants.INACTIVE_STATUS'));
            $this->bids->update($bid, $bid['id']);

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

}