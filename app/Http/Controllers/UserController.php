<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User\User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $users = User::select([ DB::raw("CONCAT(first_name,' ',last_name)  AS name"), 'id', 'email', 'status', 'created_at']);
            return Datatables::of($users)
                ->filterColumn('name', function($query, $keyword) {
                    $query->whereRaw("CONCAT(first_name,' ',last_name) like ?", ["%{$keyword}%"]);
                })
                ->blacklist(['password', 'remember_token'])
                ->addColumn('actions', function ($user) {
                        $actions = '  <a href="/user/edit/' . $user->id . '" title="Edit"><i class="fa fa-edit"></i></a>';
                        $actions .= '  <a href="javascript:void(0)" class="user-delete-btn"  data-toggle="modal" data-target="#userDeleteModal" title="Remove"  data-id=' . $user->id . '><i class="fa fa-trash"></i></a>';
                        $actions .= '  <a href="/user/add/' . $user->id . '" title="Add User"><i class="fa fa-user-plus"></i></a>';
                    return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.user.user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.user-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

}
