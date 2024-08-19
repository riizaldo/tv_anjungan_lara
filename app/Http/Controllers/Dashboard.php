<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisText;
use App\Models\MasterKegiatan;
use App\Models\MasterTimer;
use Illuminate\Http\Request;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = 'Dashboard';
        $submenu = null;
        $title = 'Dashboard';

        JavaScriptFacade::put([
            'menu' => $menu,
            'submenu' => $submenu,
            'title' => $title,

        ]);

        return view('main.dashboard', compact('menu', 'submenu', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function welcome()
    {
        $menu = 'Dashboard';
        $submenu = null;
        $title = 'Dashboard';
        $judul = MasterJenisText::where('tipe', 'judul')->pluck('keterangan')->first();
        $frame1 = MasterJenisText::where('tipe', 'frame1')->pluck('keterangan')->first();
        $frame2 = MasterJenisText::where('tipe', 'frame2')->pluck('keterangan')->first();
        $footer = MasterJenisText::where('tipe', 'footer')->pluck('keterangan')->first();
        $link_youtube = MasterJenisText::where('tipe', 'link_youtube')->pluck('keterangan')->first();

        $frame3_time = MasterTimer::where('tipe', 'frame3')->pluck('timer')->first();
        $frame1_time = MasterTimer::where('tipe', 'frame1')->pluck('timer')->first();
        $frame2_time = MasterTimer::where('tipe', 'frame2')->pluck('timer')->first();
        $footer_time = MasterTimer::where('tipe', 'footer')->pluck('timer')->first();

        $kegiatan_univ = MasterKegiatan::where('tipe', 'frame_1')->orderBy('start_date', 'asc')->get();
        $kegiatan_fak = MasterKegiatan::where('tipe', 'frame_2')->orderBy('start_date', 'asc')->get();

        JavaScriptFacade::put([
            'menu' => $menu,
            'submenu' => $submenu,
            'title' => $title,
            'judul' => $judul,
            'frame1' => $frame1,
            'frame2' => $frame2,
            'footer' => $footer,
            'link_youtube' => $link_youtube,

            'frame3_time' => $frame3_time,
            'frame1_time' => $frame1_time,
            'frame2_time' => $frame2_time,
            'footer_time' => $footer_time,

            'kegiatan_univ' => $kegiatan_univ,
            'kegiatan_fak' => $kegiatan_fak,
        ]);

        return view('welcome', compact('menu', 'submenu', 'title', 'judul', 'link_youtube', 'frame1', 'frame2', 'footer', 'frame1_time', 'frame2_time', 'frame3_time', 'footer_time', 'kegiatan_univ', 'kegiatan_fak'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
