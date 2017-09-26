<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExportToCanadaPostTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function can_export_ready_orders()
    {
        $this->logAsAdmin();
        $transaction = factory(\App\Models\Transaction::class, 2)->create()[0];

        $this->visit('/admin/orders/post_canada/export.csv');

        $this->see(implode(';', [
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
            '"' . $this->getProvinceCode(json_decode($transaction->customer->preferences, true)['province']) . '"', // Province ou État
            '"' . json_decode($transaction->customer->preferences, true)['postal_code'] . '"', // Code postal ou code ZIP
            '"CA"', // Code de pays
            '""', // Numéro de téléphone vocal du client (facultatif)
            '""', // Numéro de télécopieur du client (facultatif)
            '""', // Courriel du client (facultatif)
            '""', // ID taxe/IRS/TVA (facultatif)
            '""', // Courriel 2 (facultatif)
        ]));
    }

    private function logAsAdmin()
    {
        $user = factory(\App\Models\User::class)->create([
            'role' => 'admin'
        ]);
        Auth::login($user);
    }

    private function getProvinceCode($province)
    {
        return [
            'alberta' => 'ab',
            'british-columbia' => 'bc',
            'manitoba' => 'mb',
            'new-brunswick' => 'nb',
            'newfoundland-and-labrador' => 'nl',
            'northwest-territories' => 'nt',
            'nova-scotia' => 'ns',
            'nunavut' => 'nu',
            'ontario' => 'on',
            'prince-edward-island' => 'pe',
            'quebec' => 'qc',
            'saskatchewan' => 'sk',
            'yukon' => 'yt',
        ][$province];
    }

}
