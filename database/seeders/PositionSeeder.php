<?php

namespace Database\Seeders;

use App\Models\JobPosition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // middle
        $direktur = JobPosition::create([
            'name'=>'Direktur',
            'priority'=>1,
            'prefix'=>'middle',
            'parent_id'=>null
        ]);

        // left
        $wakilDirekturKeuangan = JobPosition::create([
            'name'=>'Wakil Direktur Umum Dan Keuangan',
            'priority'=>2,
            'prefix'=>'left',
            'parent_id'=>$direktur->id
        ]);


        $bagianUmum = JobPosition::create([
            'name'=>'Bagian Umum',
            'priority'=>3,
            'prefix'=>'left',
            'parent_id'=>$wakilDirekturKeuangan->id
        ]);


        $bagianPerencanaan = JobPosition::create([
            'name'=>'Bagian Perencanaan Program',
            'priority'=>3,
            'prefix'=>'left',
            'parent_id'=>$wakilDirekturKeuangan->id
        ]);


        $bagianKeuangan = JobPosition::create([
            'name'=>'Bagian Keuangan',
            'priority'=>3,
            'prefix'=>'left',
            'parent_id'=>$wakilDirekturKeuangan->id
        ]);


        JobPosition::create([
            'name'=>'Sub Bagian Tata Usaha',
            'priority'=>4,
            'prefix'=>'left',
            'parent_id'=>$bagianUmum->id
        ]);

        JobPosition::create([
            'name'=>'Sub Bagian Kepegawaian',
            'priority'=>4,
            'prefix'=>'left',
            'parent_id'=> $bagianUmum->id
        ]);

        JobPosition::create([
            'name'=>'Sub Bagian Rumah Tangga Dan Perlengkapan',
            'priority'=>4,
            'prefix'=>'left',
            'parent_id'=>$bagianUmum->id
        ]);

        JobPosition::create([
            'name'=>'Sub Koordinator Penyusunan Program, Pelaporan Dan Evaluasi Dan Kelompok JF',
            'priority'=>4,
            'prefix'=>'left',
            'parent_id'=> $bagianPerencanaan->id
        ]);
        JobPosition::create([
            'name'=>'Sub Koordinator Hukum, Humas Dan Perpustakaan Dan Kelompok JF',
            'priority'=>4,
            'prefix'=>'left',
            'parent_id'=> $bagianPerencanaan->id
        ]);
        JobPosition::create([
            'name'=>'Sub Koordinator Rekam Medik Dan Kelompok JF',
            'priority'=>4,
            'prefix'=>'left',
            'parent_id'=> $bagianPerencanaan->id
        ]);

        JobPosition::create([
            'name'=>'Sub Koordinator Anggaran Dan Kelompok JF',
            'priority'=>4,
            'prefix'=>'left',
            'parent_id'=> $bagianKeuangan->id
        ]);
        JobPosition::create([
            'name'=>'Sub Koordinator Perbendaharaan Dan Kelompok JF',
            'priority'=>4,
            'prefix'=>'left',
            'parent_id'=> $bagianKeuangan->id
        ]);
        JobPosition::create([
            'name'=>'Sub Koordinator Verifikasi Dan Pelaporan Dan Kelompok JF',
            'priority'=>4,
            'prefix'=>'left',
            'parent_id'=> $bagianKeuangan->id
        ]);

        // right
        $wakilDirekturPelayanan = JobPosition::create([
            'name'=>'Wakil Direktur Pelayanan Dan Penunjang Medik',
            'priority'=>2,
            'prefix'=>'right',
            'parent_id'=> $direktur->id
        ]);

        $bidangKeperawatan = JobPosition::create([
            'name'=>'Bidang Keperawatan',
            'priority'=>3,
            'prefix'=>'right',
            'parent_id'=> $wakilDirekturPelayanan->id
        ]);

        JobPosition::create([
            'name'=>'Sub Koordinator Asuhan Keperawatan Dan Kebidanan Dan Kelompok JF',
            'priority'=>4,
            'prefix'=>'right',
            'parent_id'=> $bidangKeperawatan->id
        ]);
        JobPosition::create([
            'name'=>'Sub Koordinator Etika Mutu Keperawatan Dan Kebidanan Dan Kelompok JF',
            'priority'=>4,
            'prefix'=>'right',
            'parent_id'=>$bidangKeperawatan->id
        ]);
        $bidangPelayananMedik = JobPosition::create([
            'name'=>'Bidang Pelayanan Medik',
            'priority'=>3,
            'prefix'=>'right',
            'parent_id'=> $wakilDirekturPelayanan->id
        ]);
        $bidangPenunjangMedik = JobPosition::create([
            'name'=>'Bidang Penunjang Medik',
            'priority'=>3,
            'prefix'=>'right',
            'parent_id'=> $wakilDirekturPelayanan->id
        ]);
        JobPosition::create([
            'name'=>'Sub Koordinator Nosokomial Dan Loundry Dan Kelompok JF',
            'priority'=>4,
            'prefix'=>'right',
            'parent_id'=> $bidangPenunjangMedik->id
        ]);
        JobPosition::create([
            'name'=>'Sub Koordiantor Alat Kesehatan Dan Kelompok JF',
            'priority'=>4,
            'prefix'=>'right',
            'parent_id'=> $bidangPenunjangMedik->id
        ]);

        // bottom
        JobPosition::create([
            'name'=>'Panitia',
            'priority'=>4,
            'prefix'=>'middle',
            'parent_id'=> $direktur->id
        ]);
        JobPosition::create([
            'name'=>'TIM',
            'priority'=>4,
            'prefix'=>'middle',
            'parent_id'=> $direktur->id
        ]);
        JobPosition::create([
            'name'=>'KOMITE',
            'priority'=>4,
            'prefix'=>'middle',
            'parent_id'=> $direktur->id
        ]);
        JobPosition::create([
            'name'=>'Kelompok Jabatan Fungsional',
            'priority'=>4,
            'prefix'=>'middle',
            'parent_id'=> $direktur->id
        ]);
        JobPosition::create([
            'name'=>'SPI',
            'priority'=>4,
            'prefix'=>'middle',
            'parent_id'=> $direktur->id
        ]);
        JobPosition::create([
            'name'=>'UNIT',
            'priority'=>4,
            'prefix'=>'middle',
            'parent_id'=> $direktur->id
        ]);
        JobPosition::create([
            'name'=>'Instalasi',
            'priority'=>4,
            'prefix'=>'middle',
            'parent_id'=> $direktur->id
        ]);
        JobPosition::create([
            'name'=>'Instalasi',
            'priority'=>4,
            'prefix'=>'right',
            'parent_id'=> $bidangPenunjangMedik->id
        ]);
        JobPosition::create([
            'name'=>'Instalasi',
            'priority'=>4,
            'prefix'=>'right',
            'parent_id'=> $bidangPelayananMedik->id
        ]);
        JobPosition::create([
            'name'=>'UNIT',
            'priority'=>4,
            'prefix'=>'right',
            'parent_id'=> $bidangKeperawatan->id
        ]);
        JobPosition::create([
            'name'=>'UNIT',
            'priority'=>7,
            'prefix'=>'left',
            'parent_id'=> $bagianUmum->id
        ]);
    }
}
