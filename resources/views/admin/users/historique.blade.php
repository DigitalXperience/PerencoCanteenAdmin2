@extends('layouts.admin')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Historique</h1>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div>
    </section>
<div class="card">

{{--        <div class="card-tools">--}}
{{--            <!-- Formulaire de recherche par nom et email -->--}}
{{--            <form action="{{ route('historique') }}" method="get">--}}
{{--                @csrf--}}
{{--                <div class="input-group input-group" style="width: 250px;">--}}

{{--                    <input type="text"  name="query" value="{{ $query ?? '' }}" class="form-control float-right" placeholder="Recherche par nom ou email">--}}

{{--                    <div class="input-group-append">--}}
{{--                        <button type="submit" class="btn btn-default">--}}
{{--                            <i class="fas fa-search"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}

        <!-- /.container-fluid -->

    <div class="card-header">
        <div class="card-tools">
            <!-- Formulaire de filtre par date -->
            <form action="{{ route('filter.user_logs') }}" method="get">
                @csrf
                <div class="input-group" style="width: 250px;">
                    <input type="date" name="selected_date" class="form-control" placeholder="Sélectionner une date" value="{{ $selectedDate ?? '' }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-filter"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
							<div class="card-body table-responsive p-0">
                                @if($userLogs->count() > 0)
								<table class="table table-hover text-nowrap">
									<thead>
										<tr>

											<th>Name</th>
											<th>Email</th>
											<th>Date</th>
                                            <th>Action</th>
										</tr>
									</thead>

									<tbody>
                                    @foreach ($userLogs as $user)
										<tr>

											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
											<td>{{ $user->logged_at }}</td>
                                            <td>{{ $user->action }}</td>
										</tr>
										@include('admin.confirm-delete')

                                        @endforeach


									</tbody>
								</table>
                                    {{ $userLogs->appends(request()->input())->links() }}

                                @else
                                    <p>Aucun resultat</p>
                                @endif

								</div>
                            </div>
						</div>
					</div>


@endsection

