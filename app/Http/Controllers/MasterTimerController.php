<?php

namespace App\Http\Controllers;

use App\Models\MasterTimer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MasterTimerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function data(Request $request)
    {
        $data = MasterTimer::orderBy('id', 'asc')->get();

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
    public function show(MasterTimer $masterTimer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterTimer $masterTimer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterTimer $master_timer)
    {
        $request->validate([
            'timer' => 'bail|required'
        ]);

        $timer = $request->timer;

        DB::beginTransaction();
        try {
            $master_timer->timer = $timer;
            $master_timer->save();
            DB::commit();
            return "sukses";
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterTimer $masterTimer)
    {
        //
    }
}
