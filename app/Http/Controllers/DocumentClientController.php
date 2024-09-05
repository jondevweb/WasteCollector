<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class DocumentClientController extends Controller
{
    public function storeDocument(Request $request){

    }

    public function store(Request $request)
    {
        $data = $request->all(); // Vos données pour le PDF
        
        // Générer le PDF (exemple avec dompdf)
        $pdf = PDF::loadView('pdf.document', compact('data'));
        
        // Télécharger le PDF
        return $pdf->download('document.pdf');

//         // $request->validate([
//         //     'pdf' => 'required|mimes:pdf|max:10000', // max 10MB
//         // ]);

//         // $pdf = PDF::loadView('app');

//         // // Lancement du téléchargement du fichier PDF
//         // // return $pdf->download(\Str::slug($request->title).".pdf");
//         // return $pdf->stream();

//         // $pdf = $request->file('pdf');
//         // $binaryPdf = file_get_contents($pdf);

//         // $document = new Document();
//         // $document->pdf = $binaryPdf;
//         // $document->save();

//         // return redirect()->back()->with('success', 'PDF uploaded successfully');
//         $request->validate([
//             'title' => 'required|string|max:255',
//         ]);

//         // Les données à passer à la vue
//         $data = ['title' => $request->title];

// // if commentaire ou photo  

//         $users = \App\Models\User::all();
     
//         foreach ($users as $user) {
//             $user->notify(new NewRowNotification());
//         }

        

//         // Générer le PDF à partir de la vue
//         $pdf = PDF::loadView('client/hello', $data);

//         // Obtenir le contenu du PDF en tant que chaîne binaire
//         $binaryPdf = $pdf->output();

//         // Créer et sauvegarder le document dans la base de données
//         // $documentClient = new DocumentClient();
//         // $documentClient->pdf = $binaryPdf;
//         // $documentClient->user_id = 1; // Associer le document à l'utilisateur authentifié
//         // $documentClient->type = 1;
//         // $documentClient->save();

//         DB::insert("insert into documents_clients (name_document_client, client_id, document_type_id, pdf_document_client, created_at, updated_at)
//                     values (?, ?, ?, ?, ?, ?)", ['userPDF', 1, 1, $binaryPdf, NULL, NULL]);

       

        // return response()->json(['id' => 1, 'success' => 'PDF uploaded and stored successfully', 'message' => 'Row added successfully']);
    }

    public function show($id)
    {
        $document = Document::findOrFail($id);

        return response($document->pdf)
            ->header('Content-Type', 'application/pdf');
    }

    public function destroyDocument(string $id){

    }
    
    public function indexDocument(){

    }
    
    public function findDocumentById(){

    }

    public function DownloadDocument(){

    }
}
