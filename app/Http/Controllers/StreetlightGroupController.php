<?php

namespace App\Http\Controllers;

use App\Models\StreetlightGroup;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class StreetlightGroupController extends Controller
{
    public function index()
    {
        $group = null;
        if (session('group_id')) {
            $group = StreetlightGroup::find(session('group_id'));
        }
        return view('streetlight_group.index', ['group' => $group]);
    }

    public function set_session(Request $req)
    {
        session(['group_id' => $req->group_id]);
        return response()->json(session('group_id') ? true : false);
    }

    public function clear_session()
    {
        session()->forget('group_id');
        return redirect()->back();
    }

    public function get_streetlights(Request $req)
    {
        $streetlights = null;
        if (session('group_id')) {
            $group = StreetlightGroup::find(session('group_id'));
            $streetlights = $group->streetlights()->orderBy('order', 'asc')->get();
        }
        return json_encode($streetlights);
    }

    public function data(Request $req)
    {
        if (!$req->ajax()) return abort(403);
        $data = StreetlightGroup::orderBy('code', 'asc')->get();
        return DataTables::of($data)->addIndexColumn()
            ->addColumn('action', function ($row) {
                $id = $row['id'];
                $route_edit = route('streetlight_group.edit', ['streetlight_group' => $id]);
                $route_destroy = route('streetlight_group.destroy');
                $buttons = "
                    <a class='btn btn-sm btn-primary capitalize text-xs rounded-sm lihat' data-id='$id' href=''><i class='fa-solid fa-eye'></i></a>
                    <a class='btn btn-sm btn-success capitalize text-xs rounded-sm' href='$route_edit'><i class='fa-solid fa-edit'></i></a>
                    <a class='btn btn-sm btn-error capitalize text-xs rounded-sm' data-id='$id' href='$route_destroy'><i class='fa-solid fa-trash'></i></a>
                ";
                return $buttons;
            })->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('streetlight_group.form');
    }


    public function store(Request $req)
    {
        $val = $req->validate([
            'code' => ['required', 'max:255'],
            'street' => ['required', 'max:255']
        ]);
        $data = StreetlightGroup::create($val);
        Alert::toast('Berhasil Tambah Data!', 'success');
        return redirect()->route('streetlight_group.index');
    }

    public function show(StreetlightGroup $streetlight_group)
    {
        //
    }

    public function edit(StreetlightGroup $streetlight_group)
    {
        //
    }

    public function update(Request $req, StreetlightGroup $streetlight_group)
    {
        //
    }

    public function destroy(StreetlightGroup $streetlight_group)
    {
        //
    }
}
