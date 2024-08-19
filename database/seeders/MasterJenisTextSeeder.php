<?php

namespace Database\Seeders;

use App\Models\MasterJenisText;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterJenisTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['judul', 'frame1', 'frame2', 'footer', 'link_youtube'];
        $jenis = ['Universitas Wahid Hasyim', 'KEGIATAN UNIVERSITAS', 'KEGIATAN FAKULTAS / UNIT / BAGIAN',  'Support kami dengan follow sosial media resmi kami, Youtube : <i>UnwahasTV<i> dan Instagram <i>@unwahasaja</i>', '<iframe src="https://www.youtube.com/embed/videoseries?list=PLX42ah5YzoVshPfz6t4LSi2_VV3G0GsCe&autoplay=0&enablejsapi=1&version=3" frameborder="0" allowfullscreen> </iframe>'];

        foreach ($roles as $index => $role) {
            $newRole =
                MasterJenisText::create([
                    'tipe' => $role,
                    'keterangan' => $jenis[$index]
                ]);
        }
    }
}
