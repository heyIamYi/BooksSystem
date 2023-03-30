<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserGroup;

class UserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(file_get_contents(__DIR__ . '/json/usergroup.json'), true);
        $this->migrate($data);
    }

    public function migrate($data)
    {
        foreach ($data as $item)
        {
            $user = UserGroup::create($item);
        }
    }
}
