<?php

namespace App\Http\Controllers;

use App\Models\Streetlight;
use App\Models\StreetlightGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class StreetlightController extends Controller
{
    public function index()
    {
        $streetlight = null;
        if (session('streetlight_id')) {
            $streetlight = Streetlight::with(['streetlight_group:id,code,street', 'images:id,streetlight_id,img_path'])->find(session('streetlight_id'));
        }
        return view('streetlight/index', ['streetlight' => $streetlight]);
    }

    public function set_session(Request $req)
    {
        session(['streetlight_id' => $req->streetlight_id]);
        return response()->json(session('streetlight_id') ? true : false);
    }

    public function clear_session()
    {
        session()->forget('streetlight_id');
        return redirect()->back();
    }

    public function data(Request $req)
    {
        if (!$req->ajax()) return abort(403);
        $data = Streetlight::with(['streetlight_group:id,code'])->latest()->get();
        return DataTables::of($data)->addIndexColumn()
            ->addColumn('group_name', function ($row) {
                $code = $row['streetlight_group']->code;
                $name = $row['name'];
                $active = null;
                if (session('streetlight_id') == $row['id']) {
                    $active = "<div class='badge badge-success badge-xs'></div>";
                }
                return $active . "$code - $name";
            })->addColumn('status', function ($row) {
                $status = $row['status'];
                $color = 'neutral';
                if ($status == 'Aktif') {
                    $color = 'primary';
                } elseif ($status == 'Rusak') {
                    $color = 'secondary';
                } elseif ($status == 'Dalam Pemeliharaan') {
                    $color = 'warning';
                } elseif ($status == 'Mati') {
                    $color = 'error';
                }
                return "<div class='badge badge-$color text-xs'>$status</div>";
            })->addColumn('rate', function ($row) {
                $power = $row['power_rate'] ?? null;
                $voltage = $row['voltage_rate'] ?? null;
                if ($power && $voltage) {
                    list($voltage, $type) = explode('/', $voltage);
                    return "$power W - $voltage V $type";
                }
                return "";
            })->addColumn('action', function ($row) {
                $id = $row['id'];
                $route_edit = route('streetlight.edit', ['streetlight' => $id]);
                $route_destroy = route('streetlight.destroy', ['streetlight' => $id]);
                $buttons = "
                    <a class='btn btn-sm btn-primary capitalize text-xs rounded-sm lihat' data-id='$id' href=''><i class='fa-solid fa-eye'></i></a>
                    <a class='btn btn-sm btn-success capitalize text-xs rounded-sm' href='$route_edit'><i class='fa-solid fa-edit'></i></a>
                    <a class='btn btn-sm btn-error capitalize text-xs rounded-sm delete' data-id='$id' href='$route_destroy'><i class='fa-solid fa-trash'></i></a>
                ";
                return $buttons;
            })->rawColumns(['group_name', 'status', 'action'])
            ->make(true);
    }

    public function create()
    {
        return view('streetlight.form', [
            'button' => 'Create',
            'action' => route('streetlight.store')
        ]);
    }

    public function store(Request $req)
    {
        $req->validate([
            'streetlight_group_id' => ['required'],
            'order' => ['required'],
            'name' => ['required'],
            'lat' => ['required'],
            'long' => ['required'],
            'type' => ['nullable'],
            'status' => ['nullable'],
            'model' => ['nullable'],
            'height' => ['nullable', 'numeric'],
            'power_rate' => ['nullable', 'numeric'],
            'voltage_rate_rate' => ['nullable', 'numeric'],
            'voltage_rate_type' => ['nullable'],
            'illumination_level' => ['nullable', 'numeric'],
            'manufacturer' => ['nullable'],
        ]);

        $val = $req->except(['voltage_rate_rate', 'voltage_rate_type']);
        $val['voltage_rate'] = $req->voltage_rate_rate == '' ? null : $req->voltage_rate_rate . '/' . $req->voltage_rate_type;
        $data = Streetlight::create($val);
        Alert::toast('Berhasil Tambah Data!', 'success');
        return redirect()->route('streetlight.index');
    }

    public function show(Streetlight $streetlight)
    {
        return response()->json($streetlight);
    }

    public function edit(Streetlight $streetlight)
    {
        return view('streetlight.form', [
            'button' => 'Edit',
            'action' => route('streetlight.update', ['streetlight' => $streetlight->id]),
            'data' => $streetlight->load('streetlight_group'),
        ]);
    }

    public function update(Request $req, Streetlight $streetlight)
    {
        $req->validate([
            'streetlight_group_id' => ['required'],
            'order' => ['required'],
            'name' => ['required'],
            'lat' => ['required'],
            'long' => ['required'],
            'type' => ['nullable'],
            'status' => ['nullable'],
            'model' => ['nullable'],
            'height' => ['nullable', 'numeric'],
            'power_rate' => ['nullable', 'numeric'],
            'voltage_rate_rate' => ['nullable', 'numeric'],
            'voltage_rate_type' => ['nullable'],
            'illumination_level' => ['nullable', 'numeric'],
            'manufacturer' => ['nullable'],
        ]);

        $val = $req->except(['voltage_rate_rate', 'voltage_rate_type']);
        $val['voltage_rate'] = $req->voltage_rate_rate == '' ? null : $req->voltage_rate_rate . '/' . $req->voltage_rate_type;
        $streetlight->update($val);
        Alert::toast('Berhasil Update Data!', 'success');
        return redirect()->route('streetlight.index');
    }

    public function destroy(Streetlight $streetlight)
    {
        try {
            $streetlight->delete();
            Alert::toast('Berhasil Hapus Data!', 'success');
            $this->clear_session();
            return response()->json(true);
        } catch (\Throwable $th) {
            Alert::toast('Gagal Hapus Data!', 'error');
            return response()->json(false);
        }
    }

    public function get_streetlight(Request $req)
    {
        if (!$req->ajax()) return abort(403);
        $q = $req->q ?? '';
        $groups = StreetlightGroup::with('streetlights:id,streetlight_group_id,name')
            ->select(['id', 'code', 'street'])
            ->where('code', 'like', "%$q%")
            ->orWhere('street', 'like', "%$q%")
            ->orWhereHas('streetlights', function (Builder $query) use ($q) {
                $query->where('name', 'like', "%$q%");
            })->orderBy('code', 'asc')->get();
        $data = [];
        foreach ($groups as $g) {
            foreach ($g->streetlights as $s) {
                $data[] = [
                    'id' => $s->id,
                    'item' => "$g->code - $g->street - $s->name",
                ];
            }
        }
        return response()->json($data);
    }

    public function get_streetlight_scan(Request $req)
    {
        $streetlight = Streetlight::with('streetlight_group:id,code,street')->select(['id', 'streetlight_group_id', 'name', 'lat', 'long'])->find($req->id);
        $data = "{$streetlight->streetlight_group->code} - {$streetlight->streetlight_group->street} - {$streetlight->name}";
        return response()->json([
            'data' => $data,
            'streetlight' => $streetlight
        ]);
    }
}
