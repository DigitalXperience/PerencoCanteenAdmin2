@extends('layouts.admin')

@section('content')

<!-- resources/views/rapport.blade.php -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('genererRapportUtilisateurs') }}" method="post" class="mb-5">
                @csrf
                <div class="form-group">
                    <label for="date" class="form-label">Sélectionnez une date:</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-outline-primary">Générer le rapport PDF des utilisateurs</button>
            </form>

            <form action="{{ route('genererRapportSemaine') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="dateDebut" class="form-label">Sélectionnez la date de début:</label>
                    <input type="date" id="dateDebut" name="dateDebut" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="dateFin" class="form-label">Sélectionnez la date de fin:</label>
                    <input type="date" id="dateFin" name="dateFin" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-outline-primary bg-blue">Générer le rapport PDF hebdomadaire des utilisateurs</button>
            </form>
        </div>
    </div>
</div>

@endsection
