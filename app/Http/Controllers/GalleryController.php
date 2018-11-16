<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery\Gallery;
use Yajra\Datatables\Datatables;
use App\Services\GalleryService;
use App\Http\Requests\Gallery\GalleryRequest;
use App\Http\Requests\Gallery\GalleryUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\QueryException;
use App\Exceptions\DBTransactionException;

class GalleryController extends Controller
{
    /**
     * The gallery service instance.
     *
     * @var $galleryService
     */
    protected $galleryService;


    /**
     * Create a new controller instance.
     *
     * @param  GalleryService $galleryService
     *
     */
    public function __construct(GalleryService $galleryService)
    {
        $this->middleware('auth');
        $this->galleryService = $galleryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $galleries = Gallery::select([ 'id', 'title', 'description', 'status', 'created_at']);
            return Datatables::of($galleries)
                ->addColumn('actions', function ($gallery) {
                    $actions = '  <a href="/gallery/edit/' . $gallery->id . '" title="Edit"><i class="fa fa-edit"></i></a>';
                    $actions .= '  <a href="javascript:void(0)" class="gallery-delete-btn"  data-toggle="modal" data-target="#galleryDeleteModal" title="Remove"  data-id=' . $gallery->id . '><i class="fa fa-trash"></i></a>';
                    return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.gallery.gallery');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.gallery.gallery-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Gallery\GalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $image = null;
        try {
            if ($request->hasFile('file_name')) {
                $image = $request->file('file_name');
            }
            $this->galleryService->save($request->only(['title', 'description', 'status']), $image);
            \Log::info('Image added successfully.', ["created_by" => \Auth::user()->id, "title" => $request->only('title')]);
            return redirect('/galleries')->with('message', 'Image added successfully.');

        } catch (ValidationException $e) {
            \Log::error('Failed to save image.', ["ValidationException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (QueryException $e) {
            \Log::error('Failed to save image.', ["QueryException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (DBTransactionException $e) {
            \Log::error('Failed to save image.', ["Transaction" => $e->getMessage()]);
            return redirect()->back()->with('message', 'There was a problem saving. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.gallery.gallery-edit')->with([
            'gallery' => $this->galleryService->findById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Gallery\GalleryUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryUpdateRequest $request)
    {
        $image = null;
        try {
            if ($request->hasFile('file_name')) {
                $image = $request->file('file_name');
            }
            $this->galleryService->update($request->only(['id', 'title', 'description', 'status']), $image);
            \Log::info('Image updated successfully.', ["created_by" => \Auth::user()->id, "title" => $request->only('title')]);
            return redirect('/galleries')->with('message', 'Image updated successfully.');

        } catch (ValidationException $e) {
            \Log::error('Failed to update image.', ["ValidationException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (QueryException $e) {
            \Log::error('Failed to update image.', ["QueryException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (DBTransactionException $e) {
            \Log::error('Failed to update image.', ["Transaction" => $e->getMessage()]);
            return redirect()->back()->with('message', 'There was a problem updating. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->galleryService->destroy($id);
            $response['status'] = \Config::get('constants.SUCCESS');
            $response['message'] = 'Image deleted successfully.';
            \Log::info('Image deleted successfully.', ["deleted_by" => \Auth::user()->id, "id" => $id]);
        } catch (GeneralException $e) {
            $response['status'] = \Config::get('constants.ERROR');
            $response['message'] = 'There was a problem deleting this image. Please try again.';
            \Log::error('Failed to delete image.', ["GeneralException" => $e->getMessage()]);
        }
        return response()->json($response);
    }

    /**
     *
     * @param Request $request
     * @return mixed
     */
    public function availability(Request $request)
    {
        if ($request->ajax()) {
            try {
                return $this->galleryService->titleAvailability($request->input('title'), $request->input('id'));
            } catch (ValidationException $ex) {
                return 'false';
            }
        }
    }
}
