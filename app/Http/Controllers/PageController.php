<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page\Page;
use Yajra\Datatables\Datatables;
use App\Services\PageService;
use App\Http\Requests\Page\PageRequest;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\QueryException;
use App\Exceptions\DBTransactionException;

class PageController extends Controller
{
    /**
     * The page service instance.
     *
     * @var $pageService
     */
    protected $pageService;

    /**
     * Create a new controller instance.
     *
     * @param  PageService $pageService
     *
     */
    public function __construct(PageService $pageService)
    {
        $this->middleware('auth');
        $this->pageService = $pageService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $pages = Page::select(['id', 'name', 'description', 'created_at']);
            return Datatables::of($pages)
                ->addColumn('actions', function ($page) {
                    $actions = '  <a href="/page/edit/' . $page->id . '" title="Edit"><i class="fa fa-edit"></i></a>';
                    return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('backend.page.page');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.page.page-edit')->with([
            'page' => $this->pageService->findById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Page\PageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request)
    {
        try {
            $this->pageService->update($request->except(['_method', '_token']));
            \Log::info('Page updated successfully.', ["created_by" => \Auth::user()->id, "name" => $request->only('name')]);
            return redirect('/pages')->with('message', 'Page updated successfully.');

        } catch (ValidationException $e) {
            \Log::error('Failed to save page.', ["ValidationException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (QueryException $e) {
            \Log::error('Failed to save page.', ["QueryException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (DBTransactionException $e) {
            \Log::error('Failed to save page.', ["Transaction" => $e->getMessage()]);
            return redirect()->back()->with('message', 'There was a problem saving. Please try again.');
        }
    }
}