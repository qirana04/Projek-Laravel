<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medicine;
use App\Models\Disease;

class MedicineSeeder extends Seeder
{
    public function run()
    {
        // contoh penyakit
        $flu = Disease::firstOrCreate(['name' => 'Flu']);
        $fever = Disease::firstOrCreate(['name' => 'Demam']);
        $headache = Disease::firstOrCreate(['name' => 'Sakit Kepala']);

        $m1 = Medicine::create([
            'name' => 'Paracetamol 500mg',
            'description' => 'Obat pereda nyeri dan penurun demam',
            'functions' => 'Menurunkan demam, meredakan sakit kepala dan nyeri ringan.'
        ]);
        $m1->diseases()->sync([$fever->id, $headache->id]);

        $m2 = Medicine::create([
            'name' => 'Aspirin 100mg',
            'description' => 'Obat antiinflamasi non-steroid',
            'functions' => 'Meredakan nyeri, menurunkan demam, anti-platelet pada dosis tertentu.'
        ]);
        $m2->diseases()->sync([$fever->id, $headache->id]);

        $m3 = Medicine::create([
            'name' => 'Oseltamivir',
            'description' => 'Antiviral untuk influenza',
            'functions' => 'Digunakan untuk pengobatan dan pencegahan influenza.'
        ]);
        $m3->diseases()->sync([$flu->id]);
    }
}
