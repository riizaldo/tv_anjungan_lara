<?php

namespace App\Http\Controllers;

use App\Models\SettingGambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class SettingGambarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = 'Master';
        $submenu = 'Setting Gambar';
        $title = 'Setting Gambar';
        JavaScriptFacade::put([
            'menu' => $menu,
            'submenu' => $submenu,
            'title' => $title,
        ]);
        return view('master.SettingGambar', compact('menu', 'submenu', 'title'));
        //SettingGambar
    }
    public function data(Request $request)
    {
        $data = SettingGambar::orderBy('id', 'asc')->get();

        return datatables()::of($data)
            ->addIndexColumn()
            ->make('true');
    }
    public function getlogo()
    {
        $logo = SettingGambar::where('tipe', 'logo')->orderBy('id', 'asc')->get();

        return response()->json($logo);
    }
    public function bg()
    {
        $logo = SettingGambar::where('tipe', 'bg')->orderBy('updated_at', 'desc')->first();

        return response()->json($logo);
    }
    public function getSlider()
    {
        $logo = SettingGambar::where('tipe', 'frame_3')->orderBy('id', 'asc')->get();

        return response()->json($logo);
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
        $request->validate([
            'tipe' => 'bail|required',
            'nama' => 'bail|required',
            'path' => 'bail|required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $tipe = $request->tipe;

        $nama = $request->nama;

        $imageName = time() . '.' . $request->path->extension();
        if ($tipe == 'logo') {
            $request->path->move(public_path('logo'), $imageName);
            $keterangan = 'logo/' . $imageName;
        } else if ($tipe == 'bg') {
            $request->path->move(public_path('bg'), $imageName);
            $keterangan = 'bg/' . $imageName;
        } else {
            $request->path->move(public_path('slider'), $imageName);
            $keterangan = 'slider/' . $imageName;
        }

        DB::beginTransaction();

        try {

            $data = SettingGambar::create([
                'tipe' => $tipe,
                'name' => $nama,
                'path' => $keterangan
            ]);

            DB::commit();
            return "sukses";
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SettingGambar $settingGambar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SettingGambar $settingGambar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SettingGambar $settingGambar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SettingGambar $master_gambar)
    {

        $product = SettingGambar::find($master_gambar)->first();
        $path = $product->path;
        $fullPath = public_path($path);
        DB::beginTransaction();
        try {
            if (file_exists($fullPath)) {
                unlink($fullPath); // Use unlink to delete file directly
                error_log('Attempting to delete file at: ' . $fullPath);
            } else {
                throw new \Exception("File does not exist at path: " . $fullPath);
            }
            $master_gambar->delete();
            DB::commit();
            return "sukses";
        } catch (\Exception $e) {
            DB::rollback();
            return "Error: " . $e->getMessage();
        }
    }
}
