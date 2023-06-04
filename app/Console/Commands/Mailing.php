<?php

namespace App\Console\Commands;

use App\Mail\ContactEmail;
use App\Models\Catalog;
use App\Models\Mailing as Mai;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Mailing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('mailing');

        $emails = Mai::all();
        $mes = Catalog::latest()
        ->limit(6)
        ->get();

        foreach($emails as $email)
        {
            Mail::to($email->email)->send(new ContactEmail('', '', $mes, 1));
        }

        return Command::SUCCESS;

        
    }
}
