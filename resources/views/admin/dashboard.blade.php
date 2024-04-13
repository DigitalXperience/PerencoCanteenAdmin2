@extends('layouts.admin')

@section('content')


    <section class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Dashboard</h1>
							</div>
							<div class="col-sm-6">

							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
    <section class="content">

					<!-- Default box -->
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-4 col-6">
								<div class="small-box card">
									<div class="inner">
                                        <p>Total Utilisateurs </p>
                                        <h3> {{ $total_users }}</h3>
									</div>
									<div class="icon">
										<i class="ion ion-people"></i>
									</div>
									<a href="{{ url('users') }}" class="small-box-footer text-dark">Plus d'info <i class="fas fa-arrow-circle-right"></i></a>
								</div>
							</div>

							<div class="col-lg-4 col-6">
								<div class="small-box card">
									<div class="inner">
                                        <select name="selected_date" id="selected_date">
                                            @foreach($dates as $date)
                                                <option value="{{ $date }}">{{ $date }}</option>
                                            @endforeach
                                        </select>
                                        <p id="user_count"></p>

                                    </div>
									<div class="icon">
										<i class="ion ion-stats-bars"></i>
									</div>
									<a href="#" class="small-box-footer text-dark"></a>
								</div>
							</div>

							<div class="col-lg-4 col-6">
								<div class="small-box card">
									<div class="inner">
                                        <p>Total utilisateur supprimer</p>
										<h3>{{ $total_users_del }}</h3>
									</div>
                                    <div class="icon">
                                        <i class="ion ion-people"></i>
                                    </div>
                                    <a href="{{ url('/delete_users') }}" class="small-box-footer text-dark">Plus d'info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
							</div>
						</div>
					</div>
                    <div class="row mt-5">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Email</th>
                                <th scope="col">Date d'enregistrement</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userLogs as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->logged_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
					<!-- /.card -->
				</section>
				<!-- /.content -->
    <script>
        const selectedDate = document.getElementById('selected_date');
        const userCount = document.getElementById('user_count');

        selectedDate.addEventListener('change', function() {
            const date = this.value;
            fetch(`/get-user-count?date=${date}`)
                .then(response => response.json())
                .then(data => {
                    userCount.textContent = `Nombre de personnes ayant mangé ce jour : ${data.userCount}`;
                });
        });
    </script>


@endsection
