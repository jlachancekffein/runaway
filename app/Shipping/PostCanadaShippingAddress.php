<?php

namespace App\Shipping;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;

class PostCanadaShippingAddress
{

    public static function exportToCsv(Collection $transactions)
    {
        $transactions->transform(function (Transaction $transaction) {
            return implode(';', [
                1, // Type d'enregistrement
                '"' . $transaction->customer->id . '"', // ID du client (facultatif)
                '"' . $transaction->customer->name . '"', // Nom/Titre (facultatif)
                '""', // Prénom (facultatif)
                '""', // Nom (facultatif)
                '""', // Titre/service (facultatif)
                '""', // Nom de l'entreprise (facultatif)
                '""', // Données d'adressage supplémentaires (facultatif)
                '"' . json_decode($transaction->customer->preferences, true)['address'] . '"', // Adresse Ligne 1
                '""', // Adresse Ligne 2 (facultatif)
                '"' . json_decode($transaction->customer->preferences, true)['city'] . '"', // Ville
                '"' . $transaction->customer->province_code . '"', // Province ou État
                '"' . json_decode($transaction->customer->preferences, true)['postal_code'] . '"', // Code postal ou code ZIP
                '"CA"', // Code de pays
                '""', // Numéro de téléphone vocal du client (facultatif)
                '""', // Numéro de télécopieur du client (facultatif)
                '""', // Courriel du client (facultatif)
                '""', // ID taxe/IRS/TVA (facultatif)
                '""', // Courriel 2 (facultatif)
            ]);
        });

        return $transactions->implode("\n");
    }

}