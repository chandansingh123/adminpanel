<?php

namespace App\Services;

use App\Repositories\Item\ItemContract;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\DBTransactionException;

/**
 * Class ItemService
 * @package App\Services
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
class ItemService
{

    /**
     * @var ItemContract
     */
    protected $items;

    /**
     * Create a new item repository instance.
     *
     * @param ItemContract $items
     *
     */
    public function __construct(ItemContract $items)
    {
        $this->items = $items;
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
        return $this->items->find($id);
    }

    /**
     * Retrieve all data of repository
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        return $this->items->all();
    }

    /**
     * Count the number of specified model records in the database
     *
     * @return int
     */
    public function count()
    {
        return $this->items->count();
    }

    /**
     * Save a new entity in repository
     *
     * @param array $item
     * @param  string $image
     *
     * @throws DBTransactionException
     */
    public function save($item, $image)
    {
        DB::beginTransaction();
        try {
            if (!is_null($image)) {
                $fileName = mt_rand(999, 999999) . "_" . time() . "." . $image->getClientOriginalExtension();
                //item image path
                $this->uploadOnPublic($image, $fileName);
                // $this->uploadOnS3($image, $fileName);
                $item['file_name'] = $fileName;
            }

            $item['status'] = ((array_key_exists('status', $item) && $item['status'] == 'on') ? \Config::get('constants.ACTIVE_STATUS') : \Config::get('constants.INACTIVE_STATUS'));


            $this->items->create($item);

            DB::commit();

        } catch (DBTransactionException $e) {
            DB::rollback();
            throw new DBTransactionException();
        }
    }

    /**
     * Update a entity in repository by id
     *
     * @param array $item
     * @param  string $image
     *
     * @throws DBTransactionException
     */
    public function update($item, $image)
    {
        DB::beginTransaction();
        try {
            $oldImage = $this->items->find($item['id']);
            if (!is_null($image)) {
                $fileName = mt_rand(999, 999999) . "_" . time() . "." . $image->getClientOriginalExtension();
                 $this->uploadOnPublic($image, $fileName);
                // $this->uploadOnS3($image, $fileName);
                $item['file_name'] = $fileName;

                 $this->deletePreviousImageFromPublic($oldImage);
                // $this->deletePreviousImageFromS3($oldImage);
            }

            $item['status'] = ((array_key_exists('status', $item) && $item['status'] == 'on') ? \Config::get('constants.ACTIVE_STATUS') : \Config::get('constants.INACTIVE_STATUS'));

            $this->items->update($item, $item['id']);
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
        return $this->items->delete($id);
    }

    /**
     *
     * @return mixed
     */
    public function itemDropdown()
    {
        return $this->items->lists('name', 'id');
    }

    /**
     * upload item image on public folder
     *
     * @param object $image
     * @param string $fileName
     *
     */
    private function uploadOnPublic($image, $fileName)
    {
        $destinationPath = public_path(\Config::get('constants.ITEM_IMAGE_PATH'));
        $img = Image::make($image->getRealPath());

        // resize image to fixed size
        // $img->resize(700, 350)->save($destinationPath . '/' . $fileName);
        $img->save($destinationPath . '/' . $fileName);

        $thumbPath = public_path(\Config::get('constants.ITEM_IMAGE_THUMB_PATH'));
        $img->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbPath . '/' . $fileName);
    }

    /**
     * delete item previous image from public
     *
     * @param object $oldImage
     *
     */
    private function deletePreviousImageFromPublic($oldImage)
    {
        if (!is_null($oldImage->file_name)) {
            // unlink
             @unlink(public_path(\Config::get('constants.ITEM_IMAGE_PATH')) . "/" . $oldImage->file_name);
             @unlink(public_path(\Config::get('constants.ITEM_IMAGE_THUMB_PATH')) . "/" . $oldImage->file_name);
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
            \Config::get('constants.ITEM_IMAGE_PATH') . '/' . $fileName,
             $imgResource,
             'public'
        );

        $imgThumb = Image::make($image->getRealPath());
        $imgThumb->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        });

        $imgThumbResource = $imgThumb->stream()->detach();

        Storage::disk('s3')->put(
            \Config::get('constants.ITEM_IMAGE_THUMB_PATH') . '/' . $fileName,
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
            Storage::disk('s3')->delete(\Config::get('constants.ITEM_IMAGE_PATH') . "/" . $oldImage->file_name);
            Storage::disk('s3')->delete(\Config::get('constants.ITEM_IMAGE_THUMB_PATH') . "/" . $oldImage->file_name);
        }
    }

}