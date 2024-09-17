<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use PDF;
use Storage;
use File;

class GeneratePDF implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    protected $collecte;

    /**
     * Create a new job instance.
     */
    public function __construct($collecte)
    {
        $this->collecte = $collecte;
        foreach($this->collecte as $co){
            // dd($co->date_collecte);
            $this->data = [
                'title' => $co->date_collecte,
                'content' => 'Voici le contenu du PDF généré.'
            ];
        } 
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        sleep(2);
        // foreach($this->collecte as $co){
        //     // dd($co->date_collecte);
        //     $data = [
        //         'title' => $co->date_collecte,
        //         'content' => 'Voici le contenu du PDF généré.'
        //     ];
        //     $title = $co->date_collecte;
        //     $pdf = PDF::loadView('client/pdf_view', $title);
            
        //     // dd($this->collecte);
        // } 
         // dd($this->collecte);
        // dd($this->collecte);
    }
}

// use App\Mail\WelcomeMail;
// use Mail;

// class SendWelcomeEmail implements ShouldQueue
// {
//     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//     protected $user;

//     /**
//      * Crée une nouvelle instance de job.
//      */
//     public function __construct($user)
//     {
//         $this->user = $user;
//     }

//     /**
//      * Exécute le job.
//      */
//     public function handle()
//     {
//         // Envoi de l'e-mail de bienvenue
//         Mail::to($this->user->email)->send(new WelcomeMail($this->user));
//     }
// }

