@extends('layouts.admin')

@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <h1>Graphe</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container">
            <style>
                .graph-container {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: space-around;
                    background-color: #f8f9fa;
                    padding: 20px;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    border-radius: 8px;
                }
                .graph-wrapper {
                    display: flex;
                    justify-content: space-between;
                    flex-wrap: wrap;
                    gap: 20px;
                }
                .graph {
                    flex: 1;
                    min-width: 500px;
                    max-width: 500px; /* Modification pour agrandir les graphes */
                    height: 500px;
                    background-color: #ffffff;
                    padding: 10px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    border-radius: 8px;
                }
                #myChart3 {
                    width: 500px; !important; /* Modification pour agrandir les graphes */
                    height: 500px; !important;
                }
            </style>
            <div class="graph-container">
                <form id="dateFilterForm" class="mb-4">
                    <label for="start_date">Date de début :</label>
                    <input type="date" name="start_date" id="start_date">
                    <label for="end_date">Date de fin :</label>
                    <input type="date" name="end_date" id="end_date">
                    <button type="submit" class="btn btn-outline-primary">Filtrer</button>
                </form>
                <div class="graph-wrapper">
                    <div class="graph">
                        <canvas id="myChart1"></canvas>
                    </div>
                    <div class="graph">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
                <form id="specificDateForm" class="my-4">
                    <label for="specific_date">Date spécifique :</label>
                    <input type="date" name="specific_date" id="specific_date">
                    <button type="submit" class="btn btn-outline-primary">Afficher</button>
                </form>
                <div class="graph">
                    <canvas id="myChart3"></canvas>
                </div>
            </div>
                    <script>

                        let myChart3;

                        document.getElementById('dateFilterForm').addEventListener('submit', function(event) {
                            event.preventDefault();
                            // Code pour le premier et le deuxième graphique
                        });

                        document.getElementById('specificDateForm').addEventListener('submit', function(event) {
                            event.preventDefault();

                            const specificDate = document.getElementById('specific_date').value;

                            fetch(`/doughnut/${specificDate}`)
                                .then(response => response.json())
                                .then(data => {
                                    const userCount = data.userCount;
                                    const totalUsers = data.totalUsers;

                                    const ctx3 = document.getElementById('myChart3').getContext('2d');
                                    if (myChart3) {
                                        myChart3.destroy();
                                    }
                                    myChart3 = new Chart(ctx3, {
                                        type: 'pie',
                                        data: {
                                            labels: ['Personnes ayant mangé', 'Personnes n\'ayant pas mangé'],
                                                datasets: [{
                                        data: [userCount, totalUsers - userCount],
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.5)',
                                            'rgba(54, 162, 235, 0.5)'
                                        ]
                                    }]
                                },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true,
                                                    suggestedMax: 100
                                                }
                                            },
                                            maintainAspectRatio: false, // Permet de ne pas maintenir l'aspect ratio
                                            responsive: true, // Permet au graphique d'être responsive
                                            aspectRatio: 2, // Ratio largeur/hauteur du graphique
                                        }

                                });
                                });
                        });

                    let myChart1;
                    let myChart2;

                    document.getElementById('dateFilterForm').addEventListener('submit', function(event) {
                        event.preventDefault();

                        const startDate = document.getElementById('start_date').value;
                        const endDate = document.getElementById('end_date').value;

                        fetch(`/graph?start_date=${startDate}&end_date=${endDate}`)
                            .then(response => response.json())
                            .then(data => {
                                const dates = data.dates;
                                const userCounts = data.userCounts;
                                const userPercentages = data.userPercentages;

                                // Génération de couleurs aléatoires
                                const backgroundColors = [];
                                const borderColors = [];
                                const colorOptions = [
                                    'rgba(255, 99, 132, 0.2)', 'rgba(255, 159, 64, 0.2)', 
                                    'rgba(255, 205, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 
                                    'rgba(54, 162, 235, 0.2)', 'rgba(153, 102, 255, 0.2)', 
                                    'rgba(201, 203, 207, 0.2)'
                                ];
                                for (let i = 0; i < dates.length; i++) {
                                    const randomColorIndex = Math.floor(Math.random() * colorOptions.length);
                                    backgroundColors.push(colorOptions[randomColorIndex]);
                                    borderColors.push(colorOptions[randomColorIndex].replace('0.2', '1'));
                                }

                                const ctx1 = document.getElementById('myChart1').getContext('2d');
                                if (myChart1) {
                                    myChart1.destroy();
                                }
                                myChart1 = new Chart(ctx1, {
                                    type: 'bar',
                                    data: {
                                        labels: dates,
                                        datasets: [{
                                            label: 'Nombre de personnes ayant mangé',
                                            data: userCounts,
                                            backgroundColor: backgroundColors,
                                            borderColor: borderColors,
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        },
                                        maintainAspectRatio: false, // Permet de ne pas maintenir l'aspect ratio
                                        responsive: true, // Permet au graphique d'être responsive
                                        aspectRatio: 2, // Ratio largeur/hauteur du graphique
                                    }
                                });

                                var ctx2 = document.getElementById('myChart2').getContext('2d');
                                if (myChart2) {
                                    myChart2.destroy();
                                }
                                myChart2 = new Chart(ctx2, {
                                    type: 'line',
                                    data: {
                                        labels: dates,
                                        datasets: [{
                                            label: 'Pourcentage par rapport au nombre maximal d\'utilisateurs',
                                            data: userPercentages,
                                            backgroundColor: backgroundColors,
                                            borderColor: borderColors,
                                            borderWidth: 1
                                        }],
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                suggestedMax: 100
                                            }
                                        },
                                        maintainAspectRatio: false, // Permet de ne pas maintenir l'aspect ratio
                                        responsive: true, // Permet au graphique d'être responsive
                                        aspectRatio: 2, // Ratio largeur/hauteur du graphique
                                    }
                                });
                            });
                    });
                </script>

{{--                <h2>Repas d'aujourd'hui ({{ $date }})</h2>--}}
{{--                @if ($mealsToday->isNotEmpty())--}}
{{--                    <table>--}}
{{--                        <tr>--}}
{{--                            <th>Nom</th>--}}
{{--                            <th>Email</th>--}}
{{--                        </tr>--}}
{{--                        @foreach ($mealsToday as $meal)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $meal->user->name }}</td>--}}
{{--                                <td>{{ $meal->user->email }}</td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                    </table>--}}
{{--                @else--}}
{{--                    <p>Aucun repas enregistré pour aujourd'hui.</p>--}}
{{--                @endif--}}

{{--                <h2>Repas du {{ $date }} précédent</h2>--}}
{{--                @if ($mealsPrevious->isNotEmpty())--}}
{{--                    <table>--}}
{{--                        <tr>--}}
{{--                            <th>Nom</th>--}}
{{--                            <th>Email</th>--}}
{{--                        </tr>--}}
{{--                        @foreach ($mealsPrevious as $meal)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $meal->user->name }}</td>--}}
{{--                                <td>{{ $meal->user->email }}</td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                    </table>--}}
{{--                @else--}}
{{--                    <p>Aucun repas enregistré pour le {{ $date }} précédent.</p>--}}
{{--                @endif--}}


            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->

@endsection

