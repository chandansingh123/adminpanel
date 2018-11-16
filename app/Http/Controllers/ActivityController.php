<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity\Activity;
use Yajra\Datatables\Datatables;
use App\Services\ActivityService;
use App\Http\Requests\Activity\ActivityRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\QueryException;
use App\Exceptions\DBTransactionException;

class ActivityController extends Controller
{
    /**
     * The activity service instance.
     *
     * @var $activityService
     */
    protected $activityService;

    /**
     * Create a new controller instance.
     *
     * @param  ActivityService $activityService
     *
     */
    public function __construct(ActivityService $activityService)
    {
        $this->middleware('auth');
        $this->activityService = $activityService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $activities = Activity::select(['id', DB::raw('DATE_FORMAT(activity_date,"%Y-%m-%d") AS activity_date'), 'name', 'created_at']);
            return Datatables::of($activities)
                ->addColumn('actions', function ($activity) {
                    $actions = '  <a href="/activity/edit/' . $activity->id . '" title="Edit"><i class="fa fa-edit"></i></a>';
                    $actions .= '  <a href="javascript:void(0)" class="activity-delete-btn"  data-toggle="modal" data-target="#activityDeleteModal" title="Remove"  data-id=' . $activity->id . '><i class="fa fa-trash"></i></a>';
                    return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.activity.activity');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.activity.activity-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Activity\ActivityRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ActivityRequest $request)
    {
        $image = null;
        try {
            if ($request->hasFile('file_name')) {
                $image = $request->file('file_name');
            }
            $this->activityService->save($request->only(['name', 'description', 'status','activity_date']), $image);
            \Log::info('Activity added successfully.', ["created_by" => \Auth::user()->id]);
            return redirect('/activities')->with('message', 'Activity added successfully.');

        } catch (ValidationException $e) {
            \Log::error('Failed to save activity.', ["ValidationException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (QueryException $e) {
            \Log::error('Failed to save activity.', ["QueryException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (DBTransactionException $e) {
            \Log::error('Failed to save activity.', ["Transaction" => $e->getMessage()]);
            return redirect()->back()->with('message', 'There was a problem saving. Please try again.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.activity.activity-edit')->with([
            'activity' => $this->activityService->findById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Activity\ActivityRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ActivityRequest $request)
    {
        $image = null;
        try {
            if ($request->hasFile('file_name')) {
                $image = $request->file('file_name');
            }
            $this->activityService->update($request->only(['id', 'name', 'description', 'status', 'activity_date']), $image);
            \Log::info('Activity updated successfully.', ["created_by" => \Auth::user()->id]);
            return redirect('/activities')->with('message', 'Activity updated successfully.');

        } catch (ValidationException $e) {
            \Log::error('Failed to update activity.', ["ValidationException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (QueryException $e) {
            \Log::error('Failed to update activity.', ["QueryException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (DBTransactionException $e) {
            \Log::error('Failed to update image.', ["Transaction" => $e->getMessage()]);
            return redirect()->back()->with('message', 'There was a problem updating. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->activityService->destroy($id);
            $response['status'] = \Config::get('constants.SUCCESS');
            $response['message'] = 'Activity deleted successfully.';
            \Log::info('Activity deleted successfully.', ["deleted_by" => \Auth::user()->id, "id" => $id]);
        } catch (GeneralException $e) {
            $response['status'] = \Config::get('constants.ERROR');
            $response['message'] = 'There was a problem deleting this activity. Please try again.';
            \Log::error('Failed to delete activity.', ["GeneralException" => $e->getMessage()]);
        }
        return response()->json($response);
    }
}