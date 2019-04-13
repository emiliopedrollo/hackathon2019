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
        $users = \App\User::get();

        factory(\App\Note::class, 50)->create()->each(function (\App\Note $note) use ($users) {
            $value = (int) factory(\App\Product::class, random_int(1, 5))->create([
                'note_id' => $note->id,
            ])->sum('price');

            $note->update([
                'total_value' => $value,
                'discount_value' => (int) ($value * random_int(1, 10) / 100),
            ]);

            if(random_int(1, 100) > 70) {
                $user = $users->random();
                $note->update([
                    'user_id' => $user->id
                ]);
                $user->update([
                    'cashback_available' => $user->cashback_available + $note->discount_value,
                ]);
            }

        });
    }
}
