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

        $validator = Validator::make([
            'firstname' => $user->firstname,
            'phone' => $user->phone,
            'email' => $user->email,
            'password' => $user->password,
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

            $user->role = 'admin';
            $user->save();
            $this->info('Admin successfully created');
        }

        $validator->errors()->all();
    }
}