<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Leverancier
{
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
}
