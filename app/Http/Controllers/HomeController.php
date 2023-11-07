<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\StreetlightGroup;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function get_streetlights(Request $req)
    {
        if (!$req->ajax()) return abort(403);
        $id = $req->streetlight_group_id;
        $group = StreetlightGroup::find($id);
        $streetlights = $group->streetlights()->orderBy('order', 'asc')->get();
        return response()->json($streetlights);
    }

    public function report_issue(Request $req)
    {
        $val = $req->validate([
            'streetlight_id' => ['required'],
            'category' => ['required'],
            'desc' => ['required'],
        ]);
        $data = Report::create($val);
        Alert::toast('Issue has been submitted, successfully!', 'success');
        return redirect()->route('home.index');
    }
}
