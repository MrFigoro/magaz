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
    protected $signature = 'add:admin';

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
        $email = $this->ask('What is your email?');
        $phone = $this->ask('What is your phone?');
        $password = $this->secret('What is your password?');
        $firstname = $this->ask('What is your firstname?');
        $user = new User();
        $user->email = $email;
        $user->phone = $phone;
        $user->password = $password;
        $user->firstname = $firstname;
        $user->role = 'admin';
        $user->save();
        $this->info('admin created');
    }
}
