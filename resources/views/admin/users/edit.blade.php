@extends('layouts.admin')
@section('content')
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create User</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="javascript:history.back()" class="btn btn-primary">Retour</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
                <form action="{{ url('update-user/'.$user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card ">
                        <div class="card-header">
                            <h3>Modifier un utilisateur</h3>
                        </div>
                        <div class="card-body row">
                            <div class="form-group col-md-6">
                                <label for="name">Nom</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Entrez le nom" value="{{ $user->name }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Entrez l'email" value="{{ $user->email }}" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tel">Téléphone</label>
                                <input type="text" class="form-control" id="tel" name="tel" placeholder="Entrez le numéro de téléphone" value="{{ $user->tel }}" required>
                                @error('tel')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="usertype">Type d'utilisateur</label>
                                <select class="form-control" id="usertype" name="usertype" required>
                                    <option value="user" {{ $user->usertype == 'user' ? 'selected' : '' }}>Utilisateur</option>
                                    <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Administrateur</option>
                                </select>
                                @error('usertype')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="manger">Manger</label>
                                <select class="form-control" id="manger" name="manger" required>
                                    <option value="0" {{ $user->manger == '0' ? 'selected' : '' }}>Non</option>
                                    <option value="1" {{ $user->manger == '1' ? 'selected' : '' }}>Oui</option>
                                </select>
                                @error('manger')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="compte">Compte</label>
                                <select class="form-control" id="compte" name="compte" required>
                                    <option value="0" {{ old('compte') == '0' ? 'selected' : '' }}>Bloquer</option>
                                    <option value="1" {{ old('compte') == '1' ? 'selected' : '' }}>Actif</option>
                                </select>
                                @error('compte')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success bg-green">Enregistrer</button>
                            <a href="{{ route('users') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </div>
                </form>

@endsection
