<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(file_get_contents(__DIR__ . '/json/user.json'), true);
        $this->migrate($data);
    }

    public function migrate($data)
    {
        foreach ($data as $item)
        {
            $item['password'] = Hash::make($item['password']);
            $user = User::create($item);
        }
    }
}
