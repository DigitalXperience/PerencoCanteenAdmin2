<!-- Rapport Hebdomadaire -->
<!DOCTYPE html>
<html>
<head>
    <title>Rapport Hebdomadaire</title>
    <style>
        .rapport {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
            {{--background-image: url("{{ asset('admin/img/logo.png') }}");--}}
            background-repeat: no-repeat;
            background-position: center;
            height: 100px; /* Adjust the height as needed */
            width: 200px; /* Adjust the width as needed */
        }
        .rapport h1 {
            text-align: center;
            color: #333;
        }
        .rapport table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .rapport th, .rapport td {
            border: 1px solid #333;
            padding: 8px;
        }
        .rapport th {
            background-color: #f2f2f2;
            color: #333;
        }
        .rapport tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .rapport tr:hover {
            background-color: #e9e9e9;
        }
        .page-break {
            page-break-before: always;
        }

    </style>
</head>
<body>
    <div class="logo">
        <img src="{{ $logo }}" />
    </div>
    <div class="rapport">
        <h1>Rapport</h1>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Nombre d'Utilisateurs Ayant Mangé</th>
                    <th>Total des Dépenses</th>
                </tr>
            </thead>
            <tbody>
                @foreach($statsParJour as $stat)
                <tr>
                    <td>{{ $stat['date'] }}</td>
                    <td>{{ $stat['nombreUtilisateursAyantMange'] }}</td>
                    <td>{{ $stat['nombreUtilisateursAyantMange'] * 500 }} FCFA</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p>Total des Plats Mangé: {{ $totalUtilisateursAyantMange }}</p>
        <p>Période: du {{ $dateDebut }} au {{ $dateFin }}</p>
        <table>
            <thead>
                <tr>
                    <th>Coût Total des Dépenses</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;"><strong>{{ $totalUtilisateursAyantMange * 500 }} FCFA</strong></td>
                </tr>
            </tbody>
        </table>
    </div>


</body>
</html>
