<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Request;
use Mockery;
use App\Http\Controllers\DocumentClientController;

class PDFControllerTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testGeneratePDF()
    {
        // Créez un mock pour la façade PDF
        $pdfMock = Mockery::mock('alias:PDF');
        
        // Simulez le comportement de loadView() et download()
        $pdfMock->shouldReceive('loadView')
            ->with('pdf.document', Mockery::any())
            ->once()
            ->andReturnSelf();
            
        $pdfMock->shouldReceive('download')
            ->with('document.pdf')
            ->once()
            ->andReturn(response()->make('PDF content', 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename=document.pdf',
            ]));

        // Créez une instance du contrôleur
        $controller = new DocumentClientController();
        
        // Simulez une requête
        $request = Request::create('/generate-pdf', 'POST', [
            'data' => 'test data'
        ]);

        // Appelez la méthode du contrôleur
        $response = $controller->store($request);

        // Vérifiez le statut et le type de contenu de la réponse
        $this->assertEquals(200, $response->status());
        $this->assertEquals('application/pdf', $response->headers->get('Content-Type'));
        $this->assertStringContainsString('attachment; filename=document.pdf', $response->headers->get('Content-Disposition'));
    }
}