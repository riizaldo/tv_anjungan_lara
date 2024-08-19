<ul class="scroll-content" id="categoryTable1" style="height:350px;font-size: 45px;" wire:poll.2000ms>
    @foreach ($kegiatan_univ as $index => $ku)
        @php
            $colors = ['#134f5c', '#38761d'];
            $backgroundColor = $colors[$index % count($colors)];
        @endphp
        <li class="list-group-item d-flex justify-content-center mb-3"
            style="font-size: 39px; background-color: {{ $backgroundColor }};">
            {{ $ku->kegiatan }} | {{ date('d/m/Y H:i', strtotime($ku->start_date)) }} -
            {{ date('d/m/Y H:i', strtotime($ku->end_date)) }} |
            {!! $ku->keterangan !!}
        </li>
    @endforeach
</ul>


{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('message'))
            Livewire.emit('kegiatanUpdated');
        @endif
    });
</script> --}}
