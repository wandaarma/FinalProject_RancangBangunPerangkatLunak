<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkspaceModel;
use App\Models\KelompokModel;

class WorkspaceController extends Controller
{
    public function workspace()
    {
        $userId = Auth::id();
        $datakelompokLeader = WorkspaceModel::where('leader',($userId))->get();
        $datakelompok = WorkspaceModel::join('kelompok','kelompok.id_kelompok','=','data_kelompok.id_kelompok',)->where('kelompok.id_user',Auth::id())->get(['data_kelompok.*']);
        $merged = $datakelompok->merge($datakelompokLeader);
        $all_data = $merged->all();
        return view('workspace/workspace', ['data_kelompok' => $all_data]);
    }

    public function kelompok()
    {
        $userId = Auth::id();
        $kelompok = KelompokModel::where('id_user',($userId))->get();
        return view('workspace/workspace', ['kelompok' => $kelompok]);
    }

    public function viewDataKelompok()
    {
        // mengambil data dari table pegawai
        $datakelompok = DB::table('data_kelompok')->latest()->paginate(5);



        // mengirim data pegawai ke view index
        return view('viewdatakelompok', ['data_kelompok' => $datakelompok]);
    }

    public function isiDataKelompok()
    {

        // memanggil view tambah
        return view('workspace/isidatakelompok');
    }

    public function storeDataKelompok(Request $request)
    {
        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();

        $request->file('profilimage')->storeAs('public/img', $request->file('profilimage')->hashName());
        // insert data ke table pegawai
        DB::table('data_kelompok')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'profil_image' => $request->file('profilimage')->hashName(),
            'leader' => $userId,
            'priority' => $request->priority,
            'status' => $request->status,
            'kode' => time(),
            'id_kelompok' => time()
        ]);

        // alihkan halaman ke halaman pegawai
        return redirect('/workspace');
    }

    public function joinGroup(Request $request)
    {
        // Validasi data input jika diperlukan
        $request->validate([
            'joingroup' => 'required',
        ]);

        $kode = $request->joingroup;

        // Periksa kecocokan kode kelompok dengan data yang ada di database
        $datakelompok = WorkspaceModel::where('kode', $kode)->first();

        if ($datakelompok) {
            // Kode kelompok cocok, lakukan tindakan yang diinginkan
            // Misalnya, menyimpan data kelompok dalam sesi atau variabel untuk ditampilkan di halaman selanjutnya

            $insert_kelompok = KelompokModel::create(
                ['id_kelompok'=>$datakelompok->id_kelompok,
                'id_user'=>Auth::id()]
            );
            // Redirect ke halaman yang diinginkan dengan menyertakan data kelompok
            return redirect('/workspace')->with('data_kelompok', $datakelompok);
        } else {
            // Kode kelompok tidak cocok, tampilkan pesan kesalahan atau lakukan tindakan lain
            return redirect()->back()->with('error','Group code does not match');
        }
    }

    public function overviewKelompokGet($id)
    {
        $datakelompok = WorkspaceModel::where('id',$id)->get();
        return view('workspace/overview', ['data_kelompok' => $datakelompok]);
    }

    public function overviewKelompokAdd($id)
    {
        $datakelompok = WorkspaceModel::where('id',$id)->get();
        return view('workspace/overview', ['data_kelompok' => $datakelompok]);
    }
}
