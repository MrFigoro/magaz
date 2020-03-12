<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class AddAdmin extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:admin {email} {phone} {password} {firstname}';

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
        $validator = Validator::make([
            $email = $this->argument('email'),
            $phone = $this->argument('phone'),
            $password = $this->argument('password'),
            $firstname = $this->argument('firstname'),
            'firstname' => $firstname,
            'phone' => $phone,
            'email' => $email,
            'password' => $password,
        ], [
            'firstname' => ['required'],
            'phone' => ['required', 'string', 'unique:users', 'max:20'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:5'],
        ]);
        if ($validator->fails()) {
            $this->info('Admin not created. See error messages below:');

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        } else {
            $user->email = $email;
            $user->phone = $phone;
            $user->password = $password;
            $user->firstname = $firstname;
            $user->role = 'admin';
            $user->save();
            $this->info('admin created');
        }
        $validator->errors()->all();
    }
}