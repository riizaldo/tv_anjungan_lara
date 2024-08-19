<?php

namespace App\Livewire;

use App\Events\KegiatanUpdated;
use App\Models\MasterKegiatan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Livewire\Component;

class Frame1 extends Component
{

    public $kegiatan_univ;
    protected $listeners = [
        'refreshKegiatan' => 'refreshKegiatan'
    ];


    public function mount()
    {
        Event::listen(KegiatanUpdated::class, function () {
            $this->refreshKegiatan();
        });

        $this->refreshKegiatan();
    }

    public function refreshKegiatan()
    {

        //kegiatan_univ = MasterKegiatan::where('tipe', 'frame_1')->orderBy('start_date', 'asc')->get();
        $sekarang = Carbon::now();
        $this->kegiatan_univ = MasterKegiatan::where('tipe', 'frame_1')
            // ->where('start_date', '<=', $sekarang)
            // ->where('end_date', '>=', $sekarang)
            ->orderBy('start_date', 'asc')
            ->get();
    }


    public function render()
    {
        return view('livewire.frame1');
    }
}
