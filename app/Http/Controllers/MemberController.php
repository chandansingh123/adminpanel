<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member\Member;
use Yajra\Datatables\Datatables;
use App\Services\MemberService;
use App\Http\Requests\Member\MemberRequest;
use App\Http\Requests\Member\MemberUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\QueryException;
use App\Exceptions\DBTransactionException;

class MemberController extends Controller
{
    /**
     * The member service instance.
     *
     * @var $memberService
     */
    protected $memberService;


    /**
     * Create a new controller instance.
     *
     * @param  MemberService $memberService
     *
     */
    public function __construct(MemberService $memberService)
    {
        $this->middleware('auth');
        $this->memberService = $memberService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $members = Member::select([ 'id', DB::raw("CONCAT(first_name,' ',last_name)  AS name"), 'photo', 'status', 'created_at']);
            return Datatables::of($members)
                ->addColumn('actions', function ($member) {
                    $actions = '  <a href="/member/edit/' . $member->id . '" title="Edit"><i class="fa fa-edit"></i></a>';
                    $actions .= '  <a href="javascript:void(0)" class="member-delete-btn"  data-toggle="modal" data-target="#memberDeleteModal" title="Remove"  data-id=' . $member->id . '><i class="fa fa-trash"></i></a>';
                    return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.member.member');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.member.member-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Member\MemberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request)
    {
        $image = null;
        try {
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
            }
            $this->memberService->save($request->only(['first_name', 'last_name', 'status']), $image);
            \Log::info('Member added successfully.', ["created_by" => \Auth::user()->id, "first_name" => $request->only('first_name')]);
            return redirect('/members')->with('message', 'Member added successfully.');

        } catch (ValidationException $e) {
            \Log::error('Failed to save member.', ["ValidationException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (QueryException $e) {
            \Log::error('Failed to save member.', ["QueryException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (DBTransactionException $e) {
            \Log::error('Failed to save member.', ["Transaction" => $e->getMessage()]);
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
        return view('backend.member.member-edit')->with([
            'member' => $this->memberService->findById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Member\MemberUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(MemberUpdateRequest $request)
    {
        $image = null;
        try {
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
            }
            $this->memberService->update($request->only(['id', 'first_name', 'last_name', 'status']), $image);
            \Log::info('Member updated successfully.', ["created_by" => \Auth::user()->id, "first_name" => $request->only('first_name')]);
            return redirect('/members')->with('message', 'Member updated successfully.');

        } catch (ValidationException $e) {
            \Log::error('Failed to update member.', ["ValidationException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (QueryException $e) {
            \Log::error('Failed to update member.', ["QueryException" => $e->getMessage()]);
            return redirect()->back()->with('message', $e->getMessage());

        } catch (DBTransactionException $e) {
            \Log::error('Failed to update member.', ["Transaction" => $e->getMessage()]);
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
            $this->memberService->destroy($id);
            $response['status'] = \Config::get('constants.SUCCESS');
            $response['message'] = 'Member deleted successfully.';
            \Log::info('Member deleted successfully.', ["deleted_by" => \Auth::user()->id, "id" => $id]);
        } catch (GeneralException $e) {
            $response['status'] = \Config::get('constants.ERROR');
            $response['message'] = 'There was a problem deleting this member. Please try again.';
            \Log::error('Failed to delete member.', ["GeneralException" => $e->getMessage()]);
        }
        return response()->json($response);
    }
}
