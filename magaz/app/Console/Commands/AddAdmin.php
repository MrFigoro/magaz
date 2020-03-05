<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class AddAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:admin {email : Add email} {phone} {password} {firstname}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add admin data to the table "users"';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = new User();
        $user->email = $this->argument('email');
        $user->phone = $this->argument('phone');
        $user->password = $this->argument('password');
        $user->firstname = $this->argument('firstname');
        $user->role = 'admin';
        $user->save();
        $this->info('admin created');
    }
}