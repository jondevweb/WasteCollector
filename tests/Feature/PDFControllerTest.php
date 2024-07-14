<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class PDFControllerTest extends TestCase
{
    // use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function a_user_can_generate_and_store_a_pdf()
    {
        $user = User::find(3);
        // $this->actingAs(Auth::user());
        $data = [
            'title' => 'Sample PDF Title',
        ];
        $response = $this->postJson(route('documents.store'), $data);
        $response->assertStatus(200);
        $response->assertJsonStructure(['id', 'success']);
        $documentId = $response->json('id');
        $this->assertDatabaseHas('documents', [
            'id' => $documentId,
            'user_id' => $user->id,
        ]);
        $document = Document::find($documentId);
        $this->assertNotNull($document->pdf);
        $pdfResponse = $this->get(route('documents.show', ['id' => $documentId]));
        $pdfResponse->assertStatus(200);
        $pdfResponse->assertHeader('Content-Type', 'application/pdf');
    }
}