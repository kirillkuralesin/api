<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
class RegisterUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:user {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register user';

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
        $user = User::create([
            'email' => $this->argument('email'),
            'password' => bcrypt($this->argument('password')),
            'api_token' => str_random(60)
        ]);
        $this->info('You token: ' . $user->api_token);
    }
}
