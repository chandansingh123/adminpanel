<?php

namespace App\Services;

use App\Repositories\Gallery\GalleryContract;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\DBTransactionException;

/**
 * Class GalleryService
 * @package App\Services
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
class GalleryService
{

    /**
     * @var GalleryContract
     */
    protected $galleries;

    /**
     * Create a new gallery repository instance.
     *
     * @param GalleryContract $galleries
     *
     */
    public function __construct(GalleryContract $galleries)
    {
        $this->galleries = $galleries;
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
        return $this->galleries->find($id);
    }

    /**
     * Retrieve all data of repository
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        return $this->galleries->all();
    }

    /**
     * Count the number of specified model records in the database
     *
     * @return int
     */
    public function count()
    {
        return $this->galleries->count();
    }

    /**
     * Save a new entity in repository
     *
     * @param array $gallery
     * @param  string $image
     *
     * @throws DBTransactionException
     */
    public function save($gallery, $image)
    {
        DB::beginTransaction();
        try {
            if (!is_null($image)) {
                $fileName = mt_rand(999, 999999) . "_" . time() . "." . $image->getClientOriginalExtension();
                // gallery image path
                 $this->uploadOnPublic($image, $fileName);
                // $this->uploadOnS3($image, $fileName);
                $gallery['file_name'] = $fileName;
            }

            $gallery['status'] = ((array_key_exists('status', $gallery) && $gallery['status'] == 'on') ? \Config::get('constants.ACTIVE_STATUS') : \Config::get('constants.INACTIVE_STATUS'));

            $this->galleries->create($gallery);

            DB::commit();

        } catch (DBTransactionException $e) {
            DB::rollback();
            throw new DBTransactionException();
        }
    }

    /**
     * Update a entity in repository by id
     *
     * @param array $gallery
     * @param  string $image
     *
     * @throws DBTransactionException
     */
    public function update($gallery, $image)
    {
        DB::beginTransaction();
        try {
            $oldImage = $this->galleries->find($gallery['id']);
            if (!is_null($image)) {
                $fileName = mt_rand(999, 999999) . "_" . time() . "." . $image->getClientOriginalExtension();
                // gallery image path
                $this->uploadOnPublic($image, $fileName);
                // $this->uploadOnS3($image, $fileName);
                $gallery['file_name'] = $fileName;

                 $this->deletePreviousImageFromPublic($oldImage);
                // $this->deletePreviousImageFromS3($oldImage);
            }

            $gallery['status'] = ((array_key_exists('status', $gallery) && $gallery['status'] == 'on') ? \Config::get('constants.ACTIVE_STATUS') : \Config::get('constants.INACTIVE_STATUS'));
            $this->galleries->update($gallery, $gallery['id']);

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
        return $this->galleries->delete($id);
    }

    /**
     * @param string $title
     * @param $id
     * @return boolean
     */
    public function titleAvailability($title, $id)
    {
        $galleryCount = $this->galleries->isDuplicate($title, $id);
        if ($galleryCount <= 0) {
            return 'true';
        }
        return 'false';
    }

    /**
     * upload gallery image on public folder
     *
     * @param object $image
     * @param string $fileName
     *
     */
    private function uploadOnPublic($image, $fileName)
    {
        $destinationPath = public_path(\Config::get('constants.GALLERY_IMAGE_PATH'));
        $img = Image::make($image->getRealPath());

        // resize image to fixed size
        
        $img->resize(1600, 700)->save($destinationPath . '/' . $fileName);
        // $img->resize(700, 350)->save($destinationPath . '/' . $fileName);
        $img->save($destinationPath . '/' . $fileName);

        $thumbPath = public_path(\Config::get('constants.GALLERY_IMAGE_THUMB_PATH'));
        $img->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbPath . '/' . $fileName);
    }

    /**
     * delete gallery previous image from public
     *
     * @param object $oldImage
     *
     */
    private function deletePreviousImageFromPublic($oldImage)
    {
        if (!is_null($oldImage->file_name)) {
            // unlink
            @unlink(public_path(\Config::get('constants.GALLERY_IMAGE_PATH')) . "/" . $oldImage->file_name);
            @unlink(public_path(\Config::get('constants.GALLERY_IMAGE_THUMB_PATH')) . "/" . $oldImage->file_name);
        }
    }

    /**
     * upload gallery image on aws s3 bucket
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
            \Config::get('constants.GALLERY_IMAGE_PATH') . '/' . $fileName,
            $imgResource,
            'public'
        );

        $imgThumb = Image::make($image->getRealPath());
        $imgThumb->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        });

        $imgThumbResource = $imgThumb->stream()->detach();

        Storage::disk('s3')->put(
            \Config::get('constants.GALLERY_IMAGE_THUMB_PATH') . '/' . $fileName,
            $imgThumbResource,
            'public'
        );
    }

    /**
     * delete gallery previous image from aws s3 bucket
     *
     * @param object $oldImage
     *
     */
    private function deletePreviousImageFromS3($oldImage)
    {
        if (!is_null($oldImage->file_name)) {
            Storage::disk('s3')->delete(\Config::get('constants.GALLERY_IMAGE_PATH') . "/" . $oldImage->file_name);
            Storage::disk('s3')->delete(\Config::get('constants.GALLERY_IMAGE_THUMB_PATH') . "/" . $oldImage->file_name);
        }
    }

}