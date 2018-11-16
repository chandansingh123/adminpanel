<?php

namespace App\Services;

use App\Mail\SignUp;
use App\Repositories\Customer\CustomerContract;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Facades\Mail;
use App\Exceptions\DBTransactionException;

/**
 * Class CustomerService
 * @package App\Services
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
class CustomerService
{

    /**
     * @var CustomerContract
     */
    protected $customers;


    /**
     * Create a new customer repository instance.
     *
     * @param CustomerContract $customers
     *
     */
    public function __construct(CustomerContract $customers)
    {
        $this->customers = $customers;
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
        return $this->customers->find($id);
    }

    /**
     * Retrieve all data of repository
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        return $this->customers->all();
    }

    /**
     * Count the number of specified model records in the database
     *
     * @return int
     */
    public function count()
    {
        return $this->customers->count();
    }

    /**
     * Save a new entity in repository
     *
     * @param array $customer
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws DBTransactionException
     */
    public function save($customer)
    {

        DB::beginTransaction();
        try {
            $customer['code'] = $this->genRandStr();
            $customer['password'] = bcrypt($customer['password']);
            $customer['terms'] = ((array_key_exists('terms', $customer) && $customer['terms'] == 'on') ? \Config::get('constants.ACTIVE_STATUS') : \Config::get('constants.INACTIVE_STATUS'));
            $customerModel = $this->customers->create($customer);
            Mail::to( $customer['email'])->send(new SignUp($customerModel));
            DB::commit();

        } catch (DBTransactionException $e) {
            DB::rollback();
            throw new DBTransactionException();
        }
    }

    /**
     * Update a entity in repository by id
     *
     * @param array $customer
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws GeneralException
     * @throws DBTransactionException
     */
    public function update($customer)
    {
        DB::beginTransaction();
        try {


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
        return $this->customers->delete($id);
    }

    /**
     * @param string $phone
     * @param $id
     * @return boolean
     */
    public function phoneAvailability($phone)
    {
        $customerCount = $this->customers->isDuplicate($phone);
        if ($customerCount <= 0) {
            return 'true';
        }
        return 'false';
    }

    private function genRandStr(){
        $a = $b = '';

        for($i = 0; $i < 3; $i++){
            $a .= chr(mt_rand(65, 90)); // see the ascii table why 65 to 90.
            $b .= mt_rand(0, 9);
        }

        return $a . $b;
    }

}
