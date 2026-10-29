<?php

namespace App\Http\Controllers;

use App\Models\Leverancier;

class LeverancierController extends Controller
{
    public function index()
    {
        $model = new Leverancier();

        $leveranciers = $model->getOverzichtLeveranciers();

        return view('leverancier.index', compact('leveranciers'));
    }
}
