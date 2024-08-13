<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenModel;
use App\Models\WorkspaceModel;
use DirectoryIterator;
use Illuminate\Contracts\Cache\Store;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\facades\Validator;

class DokumenController extends Controller
{

    public function store(Request $request)
    {
        if($request->hasFile('Dokumen')){
        $pdf = PDFMerger::init();
            foreach ($request->file('Dokumen') as $key => $value) {
                $pdf->addPDF($value->getPathName(), 'all');
            }
            $fileName = time().'.pdf';
            $pdf->merge();
            $pdf->save(public_path($fileName));
        }
        return response()->download(public_path($fileName));
    }

    public function show()
    {
        $data=DokumenModel::all();
        return view('merger.showfile',compact('data'));
    }

    public function view($id)
    {
        $data=DokumenModel::find($id);
        return view('merger.viewfile',compact('data'));
    }

    public function merger($id)
    {
        $datakelompok = WorkspaceModel::where('id',$id)->get();
        return view('workspace/merger', ['data_kelompok' => $datakelompok]);
    }
}
