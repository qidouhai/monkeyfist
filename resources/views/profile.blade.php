@extends('layouts.inside')

@section('content')

    <div class="container-fluid">

        {{-- User metadata --}}
        <div class="row profile_top">
            <div class="col-xs-offset-3 col-xs-6">
                <img src="" class="img-responsive img-thumbnail center-block">
            </div>
            <div class="col-xs-offset-3 col-xs-6">
                <h1 class="text-center">{{ $user->username }}</h1>
            </div>
        </div>

    </div>

@endsection