<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Jobs\GeneratePDF;
use App\Models\Client;
use App\Models\CollectePoint;
use Illuminate\Support\Facades\Auth;

class DocumentClientController extends Controller
{
    public function indexDocument2(Request $request){
        return view('client/pdf_view2');
    }

    public function indexDocument3(Request $request){
        return view('client/pdf_view3');
    }

    public function indexDocument(Request $request){

        if (Auth::check()) {
            $collectePointId = $request->session()->get("client")['collectePointId'];
            $collectePoint = CollectePoint::find($collectePointId);
            $job = new GeneratePDF($collectePoint); 
            dispatch($job);
        
            // Attendre que le job termine et obtenir les données
            $job->handle();
            // GeneratePDF::dispatch();
            return view('client/pdf_view', ['data' => $job->data]);
        } else {
            return response()->json(['result' => 'Information érronées']);
        }
    }

    public function storeDocument(Request $request){
        if (Auth::check()) {        
      
            $clientId = $request->session()->get('client')['client'];
            $collectePoint = Client::find($clientId)->collectePoint->where('id', $request->id)->first();

            $request->session()->put("client", [
                "client" => $clientId,
                'collectePointId' => $collectePoint->id
            ]);
            return response()->json(['result' => 'ok']);
        } else {
            return response()->json(['result' => 'Information érronées']);
        }
    }

    public function uploadImage(Request $request)
    {

        // dd($request->image);
        // Validation de l'image
        // $request->validate([
        //     'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        // ]);

        // Stockage de l'image
        // $image = $request->image;
        // $imageName = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move(public_path('images'), 'hello');

        // Retourner une réponse
        return response()->json(['id' => 1, 'success' => 'PDF uploaded and stored successfully', 'message' => 'Row added successfully']);
    }

//     public function storeDocument(Request $request)
//     {

//         // // Chemin de l'image (par exemple, stockée dans le dossier public)
//         // $imagePath = 'images/capture-hidden.png';

//         // // Passer le chemin de l'image à la vue
//         // $data = [
//         //     'imagePath' => $imagePath
//         // ];

//         // // Générer le PDF à partir de la vue Blade
//         // $pdf = PDF::loadView('pdf.image', $data);

//         // // Définir un nom de fichier unique pour le PDF
//         // $fileName = 'pdf_with_image_' . time() . '.pdf';

//         // // // Sauvegarder le PDF dans le système de fichiers
//         // // Storage::put('public/documents/' . $fileName, $pdf->output());
//         // return $pdf->download('document.pdf');
//         // // Retourner la réponse ou télécharger le PDF directement
//         // // return response()->json(['message' => 'PDF avec image généré avec succès', 'file_path' => 'storage/documents/' . $fileName]);

        
//         $data = [
//             'title' => 'Mon premier PDF avec Laravel',
//             'content' => 'Voici le contenu du PDF généré.'
//         ];
//         return view('client/pdf_view', $data);
//         $pdf = PDF::loadView('client/pdf_view', $data);
// // dd("hello");
//         return $pdf->download('document.pdf');
// //         $data = $request->all(); // Vos données pour le PDF
        
// //         // Générer le PDF (exemple avec dompdf)
// //         $pdf = PDF::loadView('pdf.document', compact('data'));
        
// //         // Télécharger le PDF
// //         return $pdf->download('document.pdf');

// // //         // $request->validate([
// // //         //     'pdf' => 'required|mimes:pdf|max:10000', // max 10MB
// // //         // ]);

// // //         // $pdf = PDF::loadView('app');

// // //         // // Lancement du téléchargement du fichier PDF
// // //         // // return $pdf->download(\Str::slug($request->title).".pdf");
// // //         // return $pdf->stream();

// // //         // $pdf = $request->file('pdf');
// // //         // $binaryPdf = file_get_contents($pdf);

// // //         // $document = new Document();
// // //         // $document->pdf = $binaryPdf;
// // //         // $document->save();

// // //         // return redirect()->back()->with('success', 'PDF uploaded successfully');
// // //         $request->validate([
// // //             'title' => 'required|string|max:255',
// // //         ]);

// // //         // Les données à passer à la vue
// // //         $data = ['title' => $request->title];

// // // // if commentaire ou photo  

// // //         $users = \App\Models\User::all();
     
// // //         foreach ($users as $user) {
// // //             $user->notify(new NewRowNotification());
// // //         }

        

// // //         // Générer le PDF à partir de la vue
// // //         $pdf = PDF::loadView('client/hello', $data);

// // //         // Obtenir le contenu du PDF en tant que chaîne binaire
// // //         $binaryPdf = $pdf->output();

// // //         // Créer et sauvegarder le document dans la base de données
// // //         // $documentClient = new DocumentClient();
// // //         // $documentClient->pdf = $binaryPdf;
// // //         // $documentClient->user_id = 1; // Associer le document à l'utilisateur authentifié
// // //         // $documentClient->type = 1;
// // //         // $documentClient->save();

// // //         DB::insert("insert into documents_clients (name_document_client, client_id, document_type_id, pdf_document_client, created_at, updated_at)
// // //                     values (?, ?, ?, ?, ?, ?)", ['userPDF', 1, 1, $binaryPdf, NULL, NULL]);

       

// //         // return response()->json(['id' => 1, 'success' => 'PDF uploaded and stored successfully', 'message' => 'Row added successfully']);
//     }

    public function show($id)
    {
        $document = Document::findOrFail($id);

        return response($document->pdf)
            ->header('Content-Type', 'application/pdf');
    }

    public function destroyDocument(string $id){

    }
    
    public function findDocumentById(){

    }

    public function DownloadDocument(){

    }
}
