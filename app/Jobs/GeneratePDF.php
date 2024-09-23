<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\ClientController;
use App\Models\CollectePoint;
use App\Models\Client;
use App\Models\User;
use App\Models\Entreprise;

class GeneratePDF implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    protected $collectePoint;

    /**
     * Create a new job instance.
     */
    public function __construct($collectePoint)
    {
        $this->collectePoint = $collectePoint;

        $client = Client::find($collectePoint->client_id);
        $user = User::find($client->user_id);
        $entrepriseId = $collectePoint->entreprise_id;
        $entreprise = Entreprise::find($entrepriseId);
        $this->data = [
            'title' => $collectePoint->id . date("Ymd") . $collectePoint->siret_entreprise,
            'year' => date("Y"),
            'nom' => $entreprise->raison_sociale_entreprise,
            'adresse' => $entreprise->adresse_administrative_entreprise,
            'siret' => $entreprise->siret_entreprise,
            'tel' => $client->telephone_client,
            'mail' => $client->email_client,
            'contact' => $user->first_name . " " . $user->name,
        ];
       
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

