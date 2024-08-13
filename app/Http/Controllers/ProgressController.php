<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkspaceModel;

class ProgressController extends Controller
{
    public function showProgress($id)
    {
        $datakelompok = WorkspaceModel::where('id',$id)->get();
        $members = DB::table('hasil_slash')->get();
        return view('workspace/progress', ['members' => $members, 'data_kelompok' => $datakelompok]);
    }

    public function updateProgress(Request $request)
    {
        $memberName = $request->input('member_name');
        $progress = $request->input('progress');
        // Update nilai progress di database
        DB::table('hasil_slash')->where('member_name', $memberName)->update(['progress' => $progress]);
        return response()->json(['success' => true]);
    }
}
