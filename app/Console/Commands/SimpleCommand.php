<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Database\Seeders\UserSeeder;
use Database\Seeders\UserGroupSeeder;
use Database\Seeders\ItemSeeder;
use Database\Seeders\ImageSeeder;


class SimpleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simple:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'initial project';

    protected $seeders = [
        'UserSeeder',
        'UserGroupSeeder',
        'ItemSeeder',
        'ImageSeeder',
    ];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('migrate:fresh');
        $this->call('passport:install');
        foreach ($this->seeders as $seeder) {
            $this->call('db:seed', [
                '--class' => $seeder,
            ]);
        }
    }
}
