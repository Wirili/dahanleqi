<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.role.index');
    }

    public function ajax(Request $request)
    {
        $filter = $request->only(['draw', 'columns', 'order', 'start', 'length']);
        $data = Role::orderBy($filter['columns'][$filter['order'][0]['column']]['data'], $filter['order'][0]['dir'])->forPage($filter['start'] / $filter['length'] + 1, $filter['length'])->get();
        $recordsTotal = Role::all()->count();
        $recordsFiltered = Role::all()->count();
        return [
            'draw' => intval($filter['draw']),
            'recordsTotal' => intval($recordsTotal),
            'recordsFiltered' => intval($recordsFiltered),
            'data' => $data->toArray()
        ];
    }
}
