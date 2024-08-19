<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;
use Yajra\DataTables\Facades\DataTables;

class MasterJenisTextController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = 'Master';
        $submenu = 'Setting Text & Timer';
        $title_kiri = 'Setting Text';
        $title_kanan = 'Setting Timer';
        $title = 'Master Setting';
        JavaScriptFacade::put([
            'menu' => $menu,
            'submenu' => $submenu,
            'title_kiri' => $title_kiri,
            'title_kanan' => $title_kanan,
            'title' => $title,
        ]);
        return view('master.mastertext', compact('menu', 'submenu', 'title', 'title_kanan', 'title_kiri'));
    }
    public function data(Request $request)
    {
        $data = MasterJenisText::orderBy('id', 'asc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->make('true');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MasterJenisText $masterJenisText)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterJenisText $masterJenisText)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterJenisText $master_text)
    {
        $request->validate([
            'keterangan' => 'bail|required'
        ]);

        $keterangan = $request->keterangan;

        DB::beginTransaction();
        try {
            $master_text->keterangan = $keterangan;
            $master_text->save();
            DB::commit();
            return "sukses";
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterJenisText $master_text)
    {
        //
    }
}
