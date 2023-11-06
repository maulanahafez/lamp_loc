<?php

namespace App\Http\Controllers;

use App\Models\StreetlightGroup;
use Illuminate\Http\Request;

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
}
