<?php

namespace App\Services;

use App\Repositories\Activity\ActivityContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\DBTransactionException;

/**
 * Class ActivityService
 * @package App\Services
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
class ActivityService
{

    /**
     * @var ActivityContract
     */
    protected $activities;


    /**
     * Create a new activity repository instance.
     *
     * @param ActivityContract $activities
     *
     */
    public function __construct(ActivityContract $activities)
    {
        $this->activities = $activities;
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
        return $this->activities->find($id);
    }

    /**
     * Retrieve all data of repository
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        return $this->activities->all();
    }

    /**
     * Count the number of specified model records in the database
     *
     * @return int
     */
    public function count()
    {
        return $this->activities->count();
    }

    /**
     * Save a new entity in repository
     *
     * @param array $activity
     * @param  string $image
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws DBTransactionException
     */
    public function save($activity, $image)
    {

        DB::beginTransaction();
        try {
            if (!is_null($image)) {
                $fileName = mt_rand(999, 999999) . "_" . time() . "." . $image->getClientOriginalExtension();
                //activity image path
                $this->uploadOnPublic($image, $fileName);
                // $this->uploadOnS3($image, $fileName);
                $activity['file_name'] = $fileName;
            }

            $activity['status'] = ((array_key_exists('status', $activity) && $activity['status'] == 'on') ? \Config::get('constants.ACTIVE_STATUS') : \Config::get('constants.INACTIVE_STATUS'));


            $this->activities->create($activity);

            DB::commit();

        } catch (DBTransactionException $e) {
            DB::rollback();
            throw new DBTransactionException();
        }
    }

    /**
     * Update a entity in repository by id
     *
     * @param array $activity
     * @param  string $image
     *
     * @throws DBTransactionException
     */
    public function update($activity, $image)
    {

        DB::beginTransaction();
        try {
            $oldImage = $this->activities->find($activity['id']);
            if (!is_null($image)) {
                $fileName = mt_rand(999, 999999) . "_" . time() . "." . $image->getClientOriginalExtension();
                // activity image path
                 $this->uploadOnPublic($image, $fileName);
                // $this->uploadOnS3($image, $fileName);
                $activity['file_name'] = $fileName;

                 $this->deletePreviousImageFromPublic($oldImage);
                // $this->deletePreviousImageFromS3($oldImage);
            }

            $activity['status'] = ((array_key_exists('status', $activity) && $activity['status'] == 'on') ? \Config::get('constants.ACTIVE_STATUS') : \Config::get('constants.INACTIVE_STATUS'));

            $this->activities->update($activity, $activity['id']);
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
        return $this->activities->delete($id);
    }

    /**
     * upload activity image on public folder
     *
     * @param object $image
     * @param string $fileName
     *
     */
    private function uploadOnPublic($image, $fileName)
    {
        $destinationPath = public_path(\Config::get('constants.ACTIVITY_IMAGE_PATH'));
        $img = Image::make($image->getRealPath());

        // resize image to fixed size
        $img->resize(700, 350)->save($destinationPath . '/' . $fileName);

        $thumbPath = public_path(\Config::get('constants.ACTIVITY_IMAGE_THUMB_PATH'));
        $img->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbPath . '/' . $fileName);
    }

    /**
     * delete activity previous image from public
     *
     * @param object $oldImage
     *
     */
    private function deletePreviousImageFromPublic($oldImage)
    {
        if (!is_null($oldImage->file_name)) {
            // unlink
            @unlink(public_path(\Config::get('constants.ACTIVITY_IMAGE_PATH')) . "/" . $oldImage->file_name);
            @unlink(public_path(\Config::get('constants.ACTIVITY_IMAGE_THUMB_PATH')) . "/" . $oldImage->file_name);
        }
    }

    /**
     * upload item image on aws s3 bucket
     *
     * @param object $image
     * @param string $fileName
     *
     */
    private function uploadOnS3($image, $fileName)
    {
        $img = Image::make($image->getRealPath());
        $img->resize(700, 350, function ($constraint) {
            $constraint->aspectRatio();
        });

        $imgResource = $img->stream()->detach();

        Storage::disk('s3')->put(
            \Config::get('constants.ACTIVITY_IMAGE_PATH') . '/' . $fileName,
            $imgResource,
            'public'
        );

        $imgThumb = Image::make($image->getRealPath());
        $imgThumb->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        });

        $imgThumbResource = $imgThumb->stream()->detach();

        Storage::disk('s3')->put(
            \Config::get('constants.ACTIVITY_IMAGE_THUMB_PATH') . '/' . $fileName,
            $imgThumbResource,
            'public'
        );
    }

    /**
     * delete activity previous image from aws s3 bucket
     *
     * @param object $oldImage
     *
     */
    private function deletePreviousImageFromS3($oldImage)
    {
        if (!is_null($oldImage->file_name)) {
            Storage::disk('s3')->delete(\Config::get('constants.ACTIVITY_IMAGE_PATH') . "/" . $oldImage->file_name);
            Storage::disk('s3')->delete(\Config::get('constants.ACTIVITY_IMAGE_THUMB_PATH') . "/" . $oldImage->file_name);
        }
    }

}