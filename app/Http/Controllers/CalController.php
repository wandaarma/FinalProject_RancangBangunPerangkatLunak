<?php


namespace App\Http\Controllers;

use App\Models\WorkspaceModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CalController extends Controller
{
    public function calendarview()
    {
        $userId = Auth::id();
        $deadlinesindividu = DB::table('data_individu')
            ->where('user_id', $userId)
            ->select('deadline', 'title')
            ->get();
        $datakelompokLeader = WorkspaceModel::where('leader', ($userId))->get();
        $datakelompok = WorkspaceModel::join('kelompok', 'kelompok.id_kelompok', '=', 'data_kelompok.id_kelompok',)->where('kelompok.id_user', Auth::id())->get(['data_kelompok.deadline', 'data_kelompok.title']);
        $merged = $datakelompok->merge($datakelompokLeader);
        $all_data = $merged->all();

        return view('calendarpage')->with('deadlinesindividu', $deadlinesindividu)
            ->with('deadlineskelompok', $all_data);
    }
}
