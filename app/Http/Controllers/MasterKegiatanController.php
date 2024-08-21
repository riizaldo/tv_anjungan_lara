<?php

namespace App\Http\Controllers;

use App\Events\KegiatanUpdated;
use App\Models\MasterJenisText;
use App\Models\MasterKegiatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;
use Yajra\DataTables\Facades\DataTables;

class MasterKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = 'Master';
        $submenu = 'Setting Kegiatan';
        $title = 'Setting Kegiatan';
        JavaScriptFacade::put([
            'menu' => $menu,
            'submenu' => $submenu,
            'title' => $title,
        ]);
        return view('master.settingkegiatans', compact('menu', 'submenu', 'title'));
    }
    public function data(Request $request)
    {
        $data = MasterKegiatan::orderBy('start_date', 'desc')->get();

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
    public function getKegiatanUniv()
    {
        $now = Carbon::now();
        $kegiatan_univ = MasterKegiatan::where('tipe', 'frame_1')
            ->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->orderBy('start_date', 'asc')
            ->get();

        return response()->json($kegiatan_univ);
    }
    public function getfooter()
    {
        $footer = MasterJenisText::where('tipe', 'footer')->get();

        return response()->json($footer);
    }
    public function getKegiatanFak()
    {
        $now = Carbon::now();
        $kegiatan_fak = MasterKegiatan::where('tipe', 'frame_2')->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->orderBy('start_date', 'asc')
            ->get();

        return response()->json($kegiatan_fak);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipe' => 'bail|required',
            'keterangan' => 'bail|required',
            'nama' => 'bail|required',
            'start_date' => 'bail|required',
            'end_date' => 'bail|required',
        ]);

        $tipe = $request->tipe;
        $keterangan = $request->keterangan;
        $nama = $request->nama;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $is_active = 1;
        DB::beginTransaction();
        try {
            $data = MasterKegiatan::create([
                'tipe' => $tipe,
                'kegiatan' => $nama,
                'keterangan' => $keterangan,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'is_active' => $is_active
            ]);
            DB::commit();
            event(new KegiatanUpdated());
            return "sukses";
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MasterKegiatan $masterKegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterKegiatan $masterKegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterKegiatan $master_kegiatan)
    {
        $request->validate([
            'tipe' => 'bail|required',
            'keterangan' => 'bail|required',
            'nama' => 'bail|required',
            'start_date' => 'bail|required',
            'end_date' => 'bail|required',
        ]);

        $tipe = $request->tipe;
        $keterangan = $request->keterangan;
        $nama = $request->nama;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $is_active = 1;

        DB::beginTransaction();
        try {
            $master_kegiatan->tipe = $tipe;
            $master_kegiatan->kegiatan = $nama;
            $master_kegiatan->keterangan = $keterangan;
            $master_kegiatan->start_date = $start_date;
            $master_kegiatan->end_date = $end_date;
            $master_kegiatan->is_active = $is_active;
            $master_kegiatan->save();
            DB::commit();
            return "sukses";
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterKegiatan $master_kegiatan)
    {
        DB::beginTransaction();
        try {
            $master_kegiatan->delete();
            DB::commit();
            return "sukses";
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
