<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLog;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class RepportController extends Controller
{
    public function genererRapport(Request $request)
    {
        $date = $request->input('date'); // Récupère la date spécifiée dans la requête
        $nombreTotalUtilisateurs = User::count(); // Compte le nombre total d'utilisateurs
        $nombreUtilisateursAyantMange = UserLog::whereDate('logged_at', $date)->count(); // Compte le nombre d'utilisateurs ayant mangé à la date spécifiée

        $data = [
            'nombreTotalUtilisateurs' => $nombreTotalUtilisateurs,
            'nombreUtilisateursAyantMange' => $nombreUtilisateursAyantMange,
            'date' => $date,
        ];

        $pdf = PDF::loadView('Rapport.rapport-journalier-pdf', $data); // Charge la vue spécifique pour le rapport journalier
        return $pdf->stream("rapport-journalier-{$date}.pdf"); // Nomme le fichier PDF selon la date
    }




    public function genererRapportSemaine(Request $request)
    {
        $dateDebut = $request->input('dateDebut');
        $dateFin = $request->input('dateFin');
        $periode = new \DatePeriod(
            new \DateTime($dateDebut),
            new \DateInterval('P1D'),
            (new \DateTime($dateFin))->modify('+1 day')
        );

        $statsParJour = [];
        $totalUtilisateursAyantMange = 0;

        foreach ($periode as $jour) {
            $date = $jour->format("Y-m-d");
            $nombreUtilisateursAyantMange = UserLog::whereDate('logged_at', $date)->count();
            $totalUtilisateursAyantMange += $nombreUtilisateursAyantMange;

            $statsParJour[] = [
                'date' => $date,
                'nombreUtilisateursAyantMange' => $nombreUtilisateursAyantMange,
            ];
        }

        $data = [
            'statsParJour' => $statsParJour,
            'totalUtilisateursAyantMange' => $totalUtilisateursAyantMange,
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin,
            'logo' => public_path('admin/img/logo.jpg'), // Chemin vers le logo de l'entreprise
        ];

        $pdf = PDF::loadView('Rapport.rapport-hebdomadaire-pdf', $data);

        // Ajout de la pagination automatique
        $pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);
        $pdf->getDomPDF()->set_option('isPhpEnabled', true);
        $pdf->getDomPDF()->set_option('isRemoteEnabled', true);
        $pdf->getDomPDF()->set_option('isJavascriptEnabled', true);
        $pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);
        $pdf->getDomPDF()->set_option('isFontSubsettingEnabled', true);
        $pdf->getDomPDF()->set_option('isCssFloatEnabled', true);
        $pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);
        $pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);

        return $pdf->stream("rapport-hebdomadaire-{$dateDebut}-au-{$dateFin}.pdf");
    }
}
