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
            <div class="col-xs-offset-3 col-xs-6 text-center">
                <span><i class="fa fa-birthday-cake" aria-hidden="true"></i>&nbsp;15.02.1992</span>
            </div>
            <div class="col-xs-offset-4 col-xs-4 text-center" style="margin-top:25px;">
                <div class="col-xs-4 text-center profile_link">
                    <a href="#"><span><i class="fa fa-envelope" aria-hidden="true"></i></span></a>
                </div>
                <div class="col-xs-4 text-center profile_link">
                    <a href="#"><span><i class="fa fa-user-plus" aria-hidden="true"></i></span></a>
                </div>
                <div class="col-xs-4 text-center profile_link">
                    <a href="#"><span><i class="fa fa-users" aria-hidden="true"></i></span></a>
                </div>
            </div>
        </div>

    </div>

@endsection