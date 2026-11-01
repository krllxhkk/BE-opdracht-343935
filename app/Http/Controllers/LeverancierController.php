<?php

namespace App\Http\Controllers;

use App\Models\Leverancier;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LeverancierController extends Controller
{
    // Toont het overzicht van alle leveranciers
    public function index()
    {
        $model = new Leverancier();

        $leveranciers = $model->getOverzichtLeveranciers();

        return view('leverancier.index', compact('leveranciers'));
    }
    // Overzicht van producten van één leverancier
public function show($leverancierId)
{
    $model = new Leverancier();

    $leverancier = $model->getLeverancierById($leverancierId);

    if (!$leverancier) {
        abort(404);
    }

    $producten = $model->getGeleverdeProducten($leverancierId);

    // Controleer of de leverancier producten heeft geleverd
    if (empty($producten)) {
        return view('leverancier.geen-producten', compact('leverancier'));
    }

    return view('leverancier.producten', compact(
        'leverancier',
        'producten'
    ));
}
// Formulier voor een nieuwe levering
public function create($leverancierId, $productId)
{
    $model = new Leverancier();

    $leverancier = $model->getLeverancierById($leverancierId);

    $product = DB::table('product')
        ->where('Id', $productId)
        ->first();

    return view('leverancier.levering', compact(
        'leverancier',
        'product'
    ));
}
// Slaat een nieuwe levering op
public function store(Request $request, $leverancierId, $productId)
{
    // Controleer de ingevoerde gegevens
    $gegevens = $request->validate([
        'aantal' => 'required|integer|min:1',
        'datum' => 'required|date',
    ]);

    $model = new Leverancier();

    // Voer de Stored Procedure uit
    $resultaat = $model->nieuweLevering(
        $leverancierId,
        $productId,
        $gegevens['aantal'],
        $gegevens['datum']
    );

    $leverancier = $model->getLeverancierById($leverancierId);

    // Controleer of het product nog actief is
    if ($resultaat['Succes'] == 0) {
        return view('leverancier.levering-melding', [
            'leverancier' => $leverancier,
            'product' => DB::table('product')->where('Id', $productId)->first(),
        ]);
    }

    // Ga terug naar het productenoverzicht
    return redirect()->route('leverancier.producten', $leverancierId);
}
    // Toont de producten van één leverancier
    public function producten($leverancierId)
    {
        $model = new Leverancier();

        $leverancier = $model->getLeverancierById($leverancierId);

        $producten = $model->getGeleverdeProducten($leverancierId);

        if (empty($producten)) {
            return view('leverancier.geen-producten', compact('leverancier'));
        }

        return view('leverancier.geleverde-producten', compact(
            'leverancier',
            'producten'
        ));
    }
}
