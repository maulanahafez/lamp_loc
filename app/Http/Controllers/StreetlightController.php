<?php

namespace App\Http\Controllers;

use App\Models\Streetlight;
use Illuminate\Http\Request;
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
                return "$code - $name";
            })
            ->addColumn('status', function ($row) {
                $status = $row['status'];
                $color = '';
                if ($status == 'Aktif') {
                    $color = 'primary';
                } elseif ($status == 'Rusak') {
                    $color = 'secondary';
                } elseif ($status == 'Dalam Pemeliharaan') {
                    $color = 'warning';
                } else {
                    $color = 'error';
                }
                return "<div class='badge badge-$color text-xs'>$status</div>";
            })->addColumn('rate', function ($row) {
                $power = $row['power_rate'];
                list($voltage, $type) = explode('/', $row['voltage_rate']);
                return "$power W - $voltage V $type";
            })->addColumn('action', function ($row) {
                $id = $row['id'];
                $route_edit = route('streetlight.edit', ['streetlight' => $id]);
                $route_destroy = route('streetlight.destroy');
                $buttons = "
                    <a class='btn btn-sm btn-primary capitalize text-xs rounded-sm lihat' data-id='$id' href=''><i class='fa-solid fa-eye'></i></a>
                    <a class='btn btn-sm btn-success capitalize text-xs rounded-sm' href='$route_edit'><i class='fa-solid fa-edit'></i></a>
                    <a class='btn btn-sm btn-error capitalize text-xs rounded-sm' data-id='$id' href='$route_destroy'><i class='fa-solid fa-trash'></i></a>
                ";
                return $buttons;
            })->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function create()
    {
        return view('streetlight.form');
    }

    public function store(Request $req)
    {
        $req->validate([
            'name' => ['nullable'],
            'lat' => ['nullable'],
            'long' => ['nullable'],
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
        $val['voltage_rate'] = $req->voltage_rate_rate . '/' . $req->voltage_rate_type;
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
        //
    }

    public function update(Request $req, Streetlight $streetlight)
    {
        //
    }

    public function destroy(Streetlight $streetlight)
    {
        //
    }
}
