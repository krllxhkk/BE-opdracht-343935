<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Leverancier
{
    // Haalt het overzicht van alle leveranciers op via een Stored Procedure
    public function getOverzichtLeveranciers()
    {
        $pdo = DB::connection()->getPdo();

        $statement = $pdo->prepare(
            'CALL sp_GetOverzichtLeveranciers()'
        );

        $statement->execute();

        $leveranciers = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $statement->closeCursor();

        return $leveranciers;
    }

    // Haalt de gegevens van één leverancier op
    public function getLeverancierById($leverancierId)
    {
        $pdo = DB::connection()->getPdo();

        $statement = $pdo->prepare(
            'SELECT Id, Naam, ContactPersoon, LeverancierNummer, Mobiel
             FROM leverancier
             WHERE Id = ?'
        );

        $statement->execute([$leverancierId]);

        $leverancier = $statement->fetch(\PDO::FETCH_ASSOC);

        $statement->closeCursor();

        return $leverancier;
    }

    // Haalt de geleverde producten op via een Stored Procedure
    public function getGeleverdeProducten($leverancierId)
    {
        $pdo = DB::connection()->getPdo();

        $statement = $pdo->prepare(
            'CALL sp_GetGeleverdeProducten(?)'
        );

        $statement->execute([$leverancierId]);

        $producten = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $statement->closeCursor();

        return $producten;
    }
    // Voegt een nieuwe levering toe via een Stored Procedure
public function nieuweLevering($leverancierId, $productId, $aantal, $datum)
{
    $pdo = DB::connection()->getPdo();

    $statement = $pdo->prepare(
        'CALL sp_NieuweLevering(?, ?, ?, ?)'
    );

    $statement->execute([
        $leverancierId,
        $productId,
        $aantal,
        $datum
    ]);

    $resultaat = $statement->fetch(\PDO::FETCH_ASSOC);

    $statement->closeCursor();

    return $resultaat;
}
}