<?php

namespace App\Http\Controllers;

use App\Models\Streetlight;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StreetlightController extends Controller
{
    public function index()
    {
        return view('streetlight/index');
    }

    public function data(Request $req)
    {
        $data = Streetlight::latest()->get();
        return DataTables::of($data)->addIndexColumn()
            ->addColumn('status', function ($row) {
                $status = $row['status'];
                $color = '';
                // 'Aktif', 'Rusak', 'Dalam Pemeliharaan', 'Mati'
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
                    <a class='btn btn-sm btn-success capitalize text-xs rounded-sm' href='$route_edit'><i class='fa-solid fa-edit'></i></a>
                    <a class='btn btn-sm btn-error capitalize text-xs rounded-sm' data-id='$id' href='$route_destroy'><i class='fa-solid fa-trash'></i></a>
                ";
                return $buttons;
            })->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function create()
    {
        return view('streetlight.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Streetlight $streetlight)
    {
        //
    }

    public function edit(Streetlight $streetlight)
    {
        //
    }

    public function update(Request $request, Streetlight $streetlight)
    {
        //
    }

    public function destroy(Streetlight $streetlight)
    {
        //
    }
}
