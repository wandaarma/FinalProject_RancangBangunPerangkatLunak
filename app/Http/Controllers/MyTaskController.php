<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\MyTaskModel;
use App\Models\WorkspaceModel;

class MyTaskController extends Controller
{
    public function isiDataIndividu()
    {
        return view('mytask/isidataindividu');
    }

    public function MyTask()
    {
        $userId = Auth::id();
        $dataindividu = MyTaskModel::where('user_id',($userId))->get();
        // $datakelompok = WorkspaceModel::where('leader',($userId))->get();
        $datakelompokLeader = WorkspaceModel::where('leader',($userId))->get();
        $datakelompok = WorkspaceModel::join('kelompok','kelompok.id_kelompok','=','data_kelompok.id_kelompok',)->where('kelompok.id_user',Auth::id())->get(['data_kelompok.*']);
        $merged = $datakelompok->merge($datakelompokLeader);
        $all_data = $merged->all();
        return view('mytask/mytask', ['data_individu' => $dataindividu], ['data_kelompok' => $all_data]);
    }

    public function storeDataIndividu(Request $request)
    {
        $userId = Auth::id();
        DB::table('data_individu')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'subtask' => $request->subtask,
            'deadline' => $request->deadline,
            'status' => $request->status,
            'user_id' => $userId
        ]);

        // Alihkan halaman ke halaman yang diinginkan
        return redirect('mytask');
    }

    public function overviewIndividuGet($id)
    {
        $dataindividu = MyTaskModel::where('id',$id)->get();
        return view('mytask/overview', ['data_individu' => $dataindividu]);
    }

    public function overviewIndividuAdd($id)
    {
        $dataindividu = MyTaskModel::where('id',$id)->get();
        return view('mytask/overview', ['data_individu' => $dataindividu]);
    }
}
