<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }

    public function data(Request $req)
    {
        $data = Report::with(['streetlight:id,streetlight_group_id,name', 'streetlight.streetlight_group:id,code,street'])->latest()->get();
        return DataTables::of($data)->addIndexColumn()
            ->addColumn('streetlight_detail', function ($row) {
                $name = $row['streetlight']->name;
                $code = $row['streetlight']->streetlight_group->code;
                $street = $row['streetlight']->streetlight_group->street;
                return "$name - $code - $street";
            })->addColumn('category', function ($row) {
                $category = $row['category'];
                $color = 'neutral';
                if ($category == 'Rusak') {
                    $color = 'primary';
                } elseif ($category == 'Mati') {
                    $color = 'secondary';
                } elseif ($category == 'Kerusakan Tiang') {
                    $color = 'warning';
                } elseif ($category == 'Gangguan Listrik') {
                    $color = 'error';
                }
                return "<div class='badge badge-$color text-xs'>$category</div>";
            })->addColumn('status', function ($row) {
                $status = $row['status'];
                $color = 'neutral';
                if ($status == 'Completed') {
                    $color = 'primary';
                }
                return "<div class='badge badge-$color badge-outline text-xs'>$status</div>";
            })->addColumn('action', function ($row) {
                $id = $row['id'];
                $route_edit = route('report.edit', ['report' => $id]);
                $route_destroy = route('report.destroy', ['report' => $id]);
                $buttons = "
                    <a class='btn btn-sm btn-primary capitalize text-xs rounded-sm lihat' data-id='$id' href=''><i class='fa-solid fa-eye'></i></a>
                    <a class='btn btn-sm btn-success capitalize text-xs rounded-sm' href='$route_edit'><i class='fa-solid fa-edit'></i></a>
                    <a class='btn btn-sm btn-error capitalize text-xs rounded-sm delete' data-id='$id' href='$route_destroy'><i class='fa-solid fa-trash'></i></a>
                ";
                return $buttons;
            })->rawColumns(['category', 'status', 'action'])
            ->make(true);
    }

    public function create()
    {
        return view('report.form', [
            'button' => 'Create',
            'action' => route('report.store')
        ]);
    }

    public function store(Request $req)
    {
        $val = $req->validate([
            'streetlight_id' => ['required'],
            'category' => ['required'],
            'desc' => ['required'],
        ]);
        $data = Report::create($val);
        Alert::toast('Berhasil Tambah Data!', 'success');
        return redirect()->route('report.index');
    }

    public function show(Report $report)
    {
        //
    }

    public function edit(Report $report)
    {
        return view('report.form', [
            'button' => 'Edit',
            'action' => route('report.update', ['report' => $report->id]),
            'data' => $report->load(['streetlight:id,streetlight_group_id,name,lat,long', 'streetlight.streetlight_group:id,code,street']),
        ]);
    }

    public function update(Request $req, Report $report)
    {
        $val = $req->validate([
            // 'streetlight_id' => ['required'],
            'category' => ['required'],
            'desc' => ['required'],
            'status' => ['nullable'],
            'staff_notes' => ['required'],
        ]);
        $report->update($val);
        Alert::toast('Berhasil Update Data!', 'success');
        return redirect()->route('report.index');
    }

    public function destroy(Report $report)
    {
        try {
            $report->delete();
            Alert::toast('Berhasil Hapus Data!', 'success');
            return response()->json(true);
        } catch (\Throwable $th) {
            Alert::toast('Gagal Hapus Data!', 'error');
            return response()->json(false);
        }
    }
}
