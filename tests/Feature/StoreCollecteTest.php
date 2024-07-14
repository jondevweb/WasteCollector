<?php

namespace Tests\Feature;

use Tests\TestCase;
use Mockery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PassageController;
use App\Http\Controllers\DechetController;
use App\Models\CollectePoint;
use App\Models\Dechet;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StoreCollecteTest extends TestCase{
    protected function tearDown(): void{
        Mockery::close();
        parent::tearDown();}
    public function testStoreCollecte(){
        Auth::shouldReceive('check')->once()->andReturn(true);
        $sessionData = ['client' => ['permissions' => ['create_collecte_client']]];
        Session::shouldReceive('get')->once()->with('client')->andReturn($sessionData);
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('session')->andReturn(Session::getFacadeRoot());
        $request->shouldReceive('date')->andReturn('21/06/2024');
        $request->shouldReceive('id')->andReturn(1);
        $request->shouldReceive('dechet')->andReturn('plastique');
        $request->shouldReceive('poids')->andReturn(100);
        $testDate = Carbon::createFromFormat('Y-m-d', '2024-06-21');
        Carbon::setTestNow($testDate);
        DB::shouldReceive('table')->andReturnSelf();
        DB::shouldReceive('insertGetId')->andReturn(1);
        DB::shouldReceive('insert')->andReturn(true);
        $collectePoint = Mockery::mock('alias:' . CollectePoint::class)->shouldReceive('getAttribute')->with('departement_collecte_point')->andReturn('SomeDepartment');
        $dechet = Mockery::mock('alias:' . Dechet::class)->shouldReceive('getAttribute')->with('id')->andReturn(1);
        $passageController = Mockery::mock(PassageController::class);
        $passageController->shouldReceive('storePassage')->with($request, 95, 1)->andReturn(true);
        $dechetController = Mockery::mock(DechetController::class);
        $dechetController->shouldReceive('updateDechet')->with($request)->andReturn(true);
        $controller = new PassageController($dechetController);
        $response = $controller->storePassage($request, 95, 1);
        $result = Session::get('client');
        $this->assertTrue($response);}}

// <?php

// namespace Tests\Feature;

// use Tests\TestCase;
// use Mockery;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Session;
// use App\Http\Controllers\PassageController;
// use App\Http\Controllers\DechetController;
// use App\Models\CollectePoint;
// use App\Models\Dechet;
// use Illuminate\Http\Request;
// use Carbon\Carbon;

// class StoreCollecteTest extends TestCase
// {
//     protected function tearDown(): void
//     {
//         Mockery::close();
//         parent::tearDown();
//     }

//     public function testStoreCollecte()
//     {
//         // Simuler la connexion d'un utilisateur
//         Auth::shouldReceive('check')->once()->andReturn(true);

//         // Mock des permissions de session
//         $sessionData = ['client' => ['permissions' => ['create_collecte_client']]];
//         Session::shouldReceive('get')->once()->with('client')->andReturn($sessionData);

//         // Mock de la requête
//         $request = Mockery::mock(Request::class);
//         $request->shouldReceive('session')->andReturn(Session::getFacadeRoot());
//         $request->shouldReceive('date')->andReturn('21/06/2024');
//         $request->shouldReceive('id')->andReturn(1);
//         $request->shouldReceive('dechet')->andReturn('plastique');
//         $request->shouldReceive('poids')->andReturn(100);

//         // Fixer la date de test
//         $testDate = Carbon::createFromFormat('Y-m-d', '2024-06-21');
//         Carbon::setTestNow($testDate);

//         // Mock de la base de données
//         DB::shouldReceive('table')->andReturnSelf();
//         DB::shouldReceive('insertGetId')->andReturn(1);
//         DB::shouldReceive('insert')->andReturn(true);

//         // Mock du modèle CollectePoint
//         $collectePoint = Mockery::mock('alias:' . CollectePoint::class)->shouldReceive('getAttribute')->with('departement_collecte_point')->andReturn('SomeDepartment');
//         // $collectePoint::shouldReceive('find')->with(1)->andReturn($collectePointInstance);

//         // Mock du modèle Dechet
//         $dechet = Mockery::mock('alias:' . Dechet::class)->shouldReceive('getAttribute')->with('id')->andReturn(1);
//         // $dechet::shouldReceive('where')->with('name_dechet', 'plastique')->andReturnSelf();
//         // $dechet::shouldReceive('first')->andReturn($dechetInstance);

//         // Mock du contrôleur PassageController
//         $passageController = Mockery::mock(PassageController::class);
//         $passageController->shouldReceive('storePassage')->with($request, 95, 1)->andReturn(true);

//         // Mock du contrôleur DechetController
//         $dechetController = Mockery::mock(DechetController::class);
//         $dechetController->shouldReceive('updateDechet')->with($request)->andReturn(true);

//         // Créer une instance du contrôleur à tester (dans ce cas, PDFController n'est plus utilisé)
//         // Injection des mocks dans le conteneur de service (si nécessaire)
//         $controller = new PassageController($dechetController);

//         // Exécution de la méthode à tester
//         $response = $controller->storePassage($request, 95, 1);

//         $result = Session::get('client');

//         // Assertions sur le résultat
//         // $this->assertArrayHasKey('permissions', $result);
//         // $this->assertContains('create_collecte_client', $result['permissions']);


//         // Assertions
//         $this->assertTrue($response); // Vérifie que la méthode a retourné true
//     }
// }
