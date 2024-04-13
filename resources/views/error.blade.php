@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('404 Error') }}</div>

                    <div class="card-body">
                        {{ __('Désolé, la page que vous recherchez est introuvable.') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

