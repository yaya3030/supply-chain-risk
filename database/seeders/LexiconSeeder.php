<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PositiveWord;
use App\Models\NegativeWord;

class LexiconSeeder extends Seeder
{
    public function run(): void
    {
        // Kata positif sesuai dokumen & tambahan logistik [cite: 416, 417, 418, 419, 420]
        $positives = ['growth', 'increase', 'profit', 'stable', 'improve', 'safe', 'smooth', 'efficient', 'accelerate', 'booming'];
        
        // Kata negatif sesuai dokumen & tambahan logistik [cite: 423, 424, 425, 426, 427]
        $negatives = ['war', 'crisis', 'inflation', 'delay', 'disaster', 'decrease', 'stuck', 'strike', 'blockade', 'shortage'];

        foreach ($positives as $word) {
            PositiveWord::create(['word' => $word]);
        }

        foreach ($negatives as $word) {
            NegativeWord::create(['word' => $word]);
        }
    }
}