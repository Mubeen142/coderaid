<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Code;

class CodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('codes.csv');
        $file = fopen($path, 'r');

        if ($file) {
            $lineNumber = 1;

            while (($line = fgetcsv($file)) !== FALSE) {
                // Assuming the CSV structure is: code, frequency
                Code::create([
                    'rank' => $lineNumber,
                    'code' => $line[0],
                    'frequency' => $line[1]
                ]);

                $lineNumber++;
            }

            fclose($file);
        }
    }
}
