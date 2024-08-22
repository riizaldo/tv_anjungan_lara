<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisText;
use App\Models\MasterKegiatan;
use App\Models\MasterTimer;
use App\Models\SettingGambar;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;
use Yajra\DataTables\DataTables;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $now = Carbon::now();
        $menu = 'Dashboard';
        $submenu = null;
        $title = 'Dashboard';
        $report_kegiatan_fak = MasterKegiatan::where('tipe', 'frame_2')->count();
        $report_kegiatan_univ = MasterKegiatan::where('tipe', 'frame_1')->count();
        $report_gambar_slider = SettingGambar::where('tipe', 'frame_3')->count();



        $logo = SettingGambar::where('tipe', 'logo')->orderBy('id', 'asc')->get();
        $slider = SettingGambar::where('tipe', 'frame_3')->orderBy('id', 'asc')->get();

        $frame3_time = MasterTimer::where('tipe', 'frame3')->pluck('timer')->first();
        $frame1_time = MasterTimer::where('tipe', 'frame1')->pluck('timer')->first();
        $frame2_time = MasterTimer::where('tipe', 'frame2')->pluck('timer')->first();
        $footer_time = MasterTimer::where('tipe', 'footer')->pluck('timer')->first();

        $kegiatan_univ = MasterKegiatan::where('tipe', 'frame_1')->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->orderBy('start_date', 'asc')
            ->get();

        $kegiatan_fak = MasterKegiatan::where('tipe', 'frame_2')->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->orderBy('start_date', 'asc')
            ->get();
        JavaScriptFacade::put([
            'menu' => $menu,
            'submenu' => $submenu,
            'title' => $title,
            'report_kegiatan_fak' => $report_kegiatan_fak,
            'report_kegiatan_univ' => $report_kegiatan_univ,
            'report_gambar_slider' => $report_gambar_slider,

        ]);

        return view('main.dashboard', compact('menu', 'submenu', 'title', 'report_kegiatan_univ', 'report_kegiatan_fak', 'report_gambar_slider'));
    }
    public function getMonthlyActivities()
    {
        $now = Carbon::now();
        $startOfMonth = $now->startOfMonth()->format('Y-m-d');
        $endOfMonth = $now->endOfMonth()->format('Y-m-d');

        $activities = MasterKegiatan::whereBetween('start_date', [$startOfMonth, $endOfMonth])
            ->get();

        $data = array_fill(1, $now->daysInMonth, 0);

        foreach ($activities as $activity) {
            $day = Carbon::parse($activity->start_date)->day; // Mengambil hari dari tanggal kegiatan
            if (isset($data[$day])) {
                $data[$day]++; // Tambahkan jumlah kegiatan untuk hari tersebut
            }
        }

        $categories = range(1, $now->daysInMonth); // Array dari 1 hingga jumlah hari dalam bulan ini
        $data = array_values($data); // Dapatkan array nilai untuk jumlah kegiatan


        return response()->json([
            'categories' => $categories,
            'data' => $data,
        ]);
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
        $now = Carbon::now();
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

        $kegiatan_univ = MasterKegiatan::where('tipe', 'frame_1')->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->orderBy('start_date', 'asc')
            ->get();
        $kegiatan_fak = MasterKegiatan::where('tipe', 'frame_2')->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->orderBy('start_date', 'asc')
            ->get();

        $logo = SettingGambar::where('tipe', 'logo')->orderBy('id', 'asc')->get();
        $slider = SettingGambar::where('tipe', 'frame_3')->orderBy('id', 'asc')->get();
        $bg = SettingGambar::where('tipe', 'bg')->orderBy('id', 'desc')->first();

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

            'slider' => $slider,
            'logo' => $logo,
            'bg' => $bg,
        ]);

        return view('welcome', compact('menu', 'submenu', 'title', 'judul', 'link_youtube', 'frame1', 'frame2', 'footer', 'frame1_time', 'frame2_time', 'frame3_time', 'footer_time', 'kegiatan_univ', 'kegiatan_fak', 'logo', 'slider', 'bg'));
    }
    public function getkegiatantomorow()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

        $data = MasterKegiatan::whereDate('start_date', $tomorrow)
            ->orderBy('start_date', 'desc')
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->make('true');
    }
    public function getkegiatannow()
    {
        $tomorrow = Carbon::now()->format('Y-m-d');

        $data = MasterKegiatan::whereDate('start_date', $tomorrow)
            ->orderBy('start_date', 'desc')
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->make('true');
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
