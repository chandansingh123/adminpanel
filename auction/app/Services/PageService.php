<?php

namespace App\Services;

use App\Repositories\Page\PageContract;
use Illuminate\Support\Facades\DB;

/**
 * Class PageService
 * @package App\Services
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
class PageService
{

    /**
     * @var PageContract
     */
    protected $pages;

    /**
     * Create a new page repository instance.
     *
     * @param PageContract $pages
     *
     */
    public function __construct(PageContract $pages)
    {
        $this->pages = $pages;
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
        return $this->pages->find($id);
    }

    /**
     * Retrieve all data of repository
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        return $this->pages->all();
    }

    /**
     * Count the number of specified model records in the database
     *
     * @return int
     */
    public function count()
    {
        return $this->pages->count();
    }

    /**
     * Save a new entity in repository
     *
     * @param array $page
     *
     * @return \Illuminate\Database\Eloquent\Model
     *
     */
    public function save($page)
    {
        $this->pages->create($page);
    }

    /**
     * Update a entity in repository by id
     *
     * @param array $page
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($page)
    {
        $this->pages->update($page, $page['id']);

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
        return $this->pages->delete($id);
    }

}