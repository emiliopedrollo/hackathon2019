<?php

use Illuminate\Database\Seeder;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Note::class)->create(5000)->each(function (\App\Note $note) {
            $value = factory(\App\Product::class, [
                'note_id' => $note->id,
            ])->create(random_int(1, 50))->sum('value');

            $note->update([
                'total_value' => $value,
                'discount_value' => $value * random_int(1, 10) / 100,
            ]);
        });
    }
}