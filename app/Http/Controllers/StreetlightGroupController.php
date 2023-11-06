<?php

namespace App\Http\Controllers;

use App\Models\Streetlight;
use App\Models\StreetlightGroup;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
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
        if (!$req->ajax()) return abort(403);
        $streetlights = null;
        if (session('group_id')) {
            $group = StreetlightGroup::find(session('group_id'));
            $streetlights = $group->streetlights()->orderBy('order', 'asc')->get();
        }
        return response()->json($streetlights);
    }

    public function get_groups(Request $req)
    {
        if (!$req->ajax()) return abort(403);
        $q = $req->q ?? '';
        $data = StreetlightGroup::selectRaw('id, CONCAT(code, " - ", street) AS item')
            ->where('code', 'like', "%$q%")->orWhere('street', 'like', "%$q%")
            ->orderBy('code')
            ->get();
        return response()->json($data);
    }

    public function data(Request $req)
    {
        if (!$req->ajax()) return abort(403);
        $data = StreetlightGroup::orderBy('code', 'asc')->get();
        return DataTables::of($data)->addIndexColumn()
            ->addColumn('code', function ($row) {
                $code = $row['code'];
                $active = null;
                if (session('group_id') == $row['id']) {
                    $active = "<div class='badge badge-success badge-xs'></div>";
                }
                return $active . $code;
            })
            ->addColumn('action', function ($row) {
                $id = $row['id'];
                $route_edit = route('streetlight_group.edit', ['streetlight_group' => $id]);
                $route_destroy = route('streetlight_group.destroy', ['streetlight_group' => $id]);
                $buttons = "
                    <a class='btn btn-sm btn-primary capitalize text-xs rounded-sm lihat' data-id='$id' href=''><i class='fa-solid fa-eye'></i></a>
                    <a class='btn btn-sm btn-success capitalize text-xs rounded-sm' href='$route_edit'><i class='fa-solid fa-edit'></i></a>
                    <a class='btn btn-sm btn-error capitalize text-xs rounded-sm delete' data-id='$id' href='$route_destroy'><i class='fa-solid fa-trash'></i></a>
                ";
                return $buttons;
            })->rawColumns(['code', 'action'])
            ->make(true);
    }

    public function create()
    {
        return view('streetlight_group.form', [
            'button' => 'Create',
            'action' => route('streetlight_group.store')
        ]);
    }


    public function store(Request $req)
    {
        $val = $req->validate([
            'code' => ['required', Rule::unique('streetlight_groups', 'code'), 'max:255'],
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
        return view('streetlight_group.form', [
            'data' => $streetlight_group,
            'button' => 'Edit',
            'action' => route('streetlight_group.update', ['streetlight_group' => $streetlight_group->id])
        ]);
    }

    public function update(Request $req, StreetlightGroup $streetlight_group)
    {
        $val = $req->validate([
            'code' => ['required', Rule::unique('streetlight_groups', 'code')->ignore($streetlight_group->id, 'id'), 'max:255'],
            'street' => ['required', 'max:255']
        ]);
        $streetlight_group->update($val);
        Alert::toast('Berhasil Update Data!', 'success');
        return redirect()->route('streetlight_group.index');
    }

    public function destroy(StreetlightGroup $streetlight_group)
    {
        try {
            DB::beginTransaction();
            $streetlights = Streetlight::where('streetlight_group_id', '=', $streetlight_group->id)->get();
            foreach ($streetlights as $item) {
                $item->delete();
            }
            $streetlight_group->delete();
            DB::commit();
            $this->clear_session();
            Alert::toast('Berhasil Hapus Data!', 'success');
            return response()->json(true);
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::toast('Gagal Hapus Data!', 'error');
            return response()->json($th->getMessage());
        }
    }
}
