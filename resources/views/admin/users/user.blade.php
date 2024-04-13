@extends('layouts.admin')

@section('content')
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Utilisateurs</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{ url('add_user') }}" class="btn btn-primary">Nouvel Utilisateur</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->

					<div class="container-fluid">
                        @if (session()->has('success'))
                            <div class="bg-green text-black px-4 py-2">
                                {{ session('success') }}
                            </div>
                        @endif
						<div class="card">
							<div class="card-header">
								<div class="card-tools">
								<form action="{{ route('users.search') }}" method="get">
									<div class="input-group input-group" style="width: 250px;">

										<input type="text"  name="query" value="" class="form-control float-right" placeholder="Recherche">

										<div class="input-group-append">
										  <button type="submit" class="btn btn-default">
											<i class="fas fa-search"></i>
										  </button>
										</div>

									  </div>
									  </form>
								</div>
							</div>
							<div class="card-body table-responsive p-0">
                                @if($users->count() > 0)
								<table class="table table-hover text-nowrap">
									<thead>
										<tr>
											<th width="60">ID</th>
											<th>Name</th>
											<th>Email</th>
											<th>Compte</th>
											<th>Type</th>
											<th width="100">Status</th>
											<th width="100">Actions</th>
										</tr>
									</thead>

									<tbody>
                                    @foreach ($users as $user)
										<tr>
											<td>{{ $user->id }}</td>
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
											<td>{{ $user->compte == 1 ? 'Actif' : 'Bloqué' }}</td>
											<td>{{ $user->usertype }}</td>
											<td>
												<svg class="text-success-500 h-6 w-6 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
													<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
												</svg>
											</td>
											<td class="flex">
												<a href="{{ url('edit/'.$user->id) }}" class="text-primary w-4 h-4 mr-2">
													<svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
														<path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
													</svg>
												</a>

												<a href="#" data-toggle="modal" data-target="#confirmDeleteModal-{{ $user->id }}" class="text-danger">
													<svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
														<path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
												  	</svg>
												</a>

											</td>
										</tr>
										@include('admin.confirm-delete')
                                        @endforeach

									</tbody>
								</table>
                                    {{ $users->appends(request()->input())->links() }}
                                @else
                                    <p>Aucun resultat</p>
                                @endif

								</div>
                            </div>
						</div>
					</div>
					<!-- /.card -->
				</section>
				<!-- /.content -->


@endsection
