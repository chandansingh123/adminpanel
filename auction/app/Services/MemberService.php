<?php

namespace App\Services;

use App\Repositories\Member\MemberContract;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\DBTransactionException;

/**
 * Class MemberService
 * @package App\Services
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
class MemberService
{

    /**
     * @var MemberContract
     */
    protected $members;

    /**
     * Create a new member repository instance.
     *
     * @param MemberContract $members
     *
     */
    public function __construct(MemberContract $members)
    {
        $this->members = $members;
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
        return $this->members->find($id);
    }

    /**
     * Retrieve all data of repository
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        return $this->members->all();
    }

    /**
     * Count the number of specified model records in the database
     *
     * @return int
     */
    public function count()
    {
        return $this->members->count();
    }

    /**
     * Save a new entity in repository
     *
     * @param array $member
     * @param  string $image
     *
     * @throws DBTransactionException
     */
    public function save($member, $image)
    {
        DB::beginTransaction();
        try {
            if (!is_null($image)) {
                $fileName = mt_rand(999, 999999) . "_" . time() . "." . $image->getClientOriginalExtension();
                // member image path
                 $this->uploadOnPublic($image, $fileName);
                // $this->uploadOnS3($image, $fileName);
                $member['photo'] = $fileName;
            }
            $member['status'] = ((array_key_exists('status', $member) && $member['status'] == 'on') ? \Config::get('constants.ACTIVE_STATUS') : \Config::get('constants.INACTIVE_STATUS'));

            $this->members->create($member);

            DB::commit();

        } catch (DBTransactionException $e) {
            DB::rollback();
            throw new DBTransactionException();
        }
    }

    /**
     * Update a entity in repository by id
     *
     * @param array $member
     * @param  string $image
     *
     * @throws DBTransactionException
     */
    public function update($member, $image)
    {
        DB::beginTransaction();
        try {
            $oldImage = $this->members->find($member['id']);
            if (!is_null($image)) {
                $fileName = mt_rand(999, 999999) . "_" . time() . "." . $image->getClientOriginalExtension();
                // member image path
                 $this->uploadOnPublic($image, $fileName);
                // $this->uploadOnS3($image, $fileName);
                $member['photo'] = $fileName;

                 $this->deletePreviousImageFromPublic($oldImage);
                // $this->deletePreviousImageFromS3($oldImage);
            }
            $member['status'] = ((array_key_exists('status', $member) && $member['status'] == 'on') ? \Config::get('constants.ACTIVE_STATUS') : \Config::get('constants.INACTIVE_STATUS'));

            $this->members->update($member, $member['id']);

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
        return $this->members->delete($id);
    }

    /**
     * Member image path
     *
     * @param object $image
     * @param string $fileName
     *
     * @return boolean
     */
    private function uploadPath($image, $fileName)
    {
        $destinationPath = public_path(\Config::get('constants.MEMBER_IMAGE_PATH'));
        $img = Image::make($image->getRealPath());

        // resize image to fixed size
        $img->resize(1600, 1200)->save($destinationPath . '/' . $fileName);

        $thumbPath = public_path(\Config::get('constants.MEMBER_IMAGE_THUMB_PATH'));
        $img->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbPath . '/' . $fileName);
    }

    /**
     * upload member image on public folder
     *
     * @param object $image
     * @param string $fileName
     *
     */
    private function uploadOnPublic($image, $fileName)
    {
        $destinationPath = public_path(\Config::get('constants.MEMBER_IMAGE_PATH'));
        $img = Image::make($image->getRealPath());

        // resize image to fixed size
        $img->resize(700, 350)->save($destinationPath . '/' . $fileName);

        $thumbPath = public_path(\Config::get('constants.MEMBER_IMAGE_THUMB_PATH'));
        $img->resize(150, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbPath . '/' . $fileName);
    }

    /**
     * delete member previous image from public
     *
     * @param object $oldImage
     *
     */
    private function deletePreviousImageFromPublic($oldImage)
    {
        if (!is_null($oldImage->file_name)) {
            // unlink
            @unlink(public_path(\Config::get('constants.MEMBER_IMAGE_PATH')) . "/" . $oldImage->file_name);
            @unlink(public_path(\Config::get('constants.MEMBER_IMAGE_THUMB_PATH')) . "/" . $oldImage->file_name);
        }
    }

    /**
     * upload member image on aws s3 bucket
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
            \Config::get('constants.MEMBER_IMAGE_PATH') . '/' . $fileName,
            $imgResource,
            'public'
        );

        $imgThumb = Image::make($image->getRealPath());
        $imgThumb->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        });

        $imgThumbResource = $imgThumb->stream()->detach();

        Storage::disk('s3')->put(
            \Config::get('constants.MEMBER_IMAGE_THUMB_PATH') . '/' . $fileName,
            $imgThumbResource,
            'public'
        );
    }

    /**
     * delete member previous image from aws s3 bucket
     *
     * @param object $oldImage
     *
     */
    private function deletePreviousImageFromS3($oldImage)
    {
        if (!is_null($oldImage->file_name)) {
            Storage::disk('s3')->delete(\Config::get('constants.MEMBER_IMAGE_PATH') . "/" . $oldImage->file_name);
            Storage::disk('s3')->delete(\Config::get('constants.MEMBER_IMAGE_THUMB_PATH') . "/" . $oldImage->file_name);
        }
    }

}