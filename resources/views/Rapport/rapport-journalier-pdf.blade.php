<!-- resources/views/rapport-utilisateurs-pdf.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Liste des Utilisateurs</title>
</head>
<body>
    <h1>Liste des Utilisateurs</h1>
    <style>
        .tableau-utilisateurs {
            width: 100%;
            border-collapse: collapse;
        }
        .tableau-utilisateurs th, .tableau-utilisateurs td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .tableau-utilisateurs th {
            background-color: #04AA6D;
            color: white;
        }
        .tableau-utilisateurs tr:nth-child(even){background-color: #f2f2f2;}
        .tableau-utilisateurs tr:hover {background-color: #ddd;}
    </style>
    <table class="tableau-utilisateurs">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Type d'utilisateur</th>
                <th>Date</th>
                <th>Nombre Total d'Utilisateurs</th>
                <th>Nombre d'Utilisateurs Ayant Mangé</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4">Rapport du {{ $date }}</td>
                <td>{{ $date }}</td>
                <td>{{ $nombreTotalUtilisateurs }}</td>
                <td>{{ $nombreUtilisateursAyantMange }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
