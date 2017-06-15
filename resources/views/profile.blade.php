@extends('layouts.inside')

@section('content')

    <div class="container-fluid">

        <div class="row profile_top">
            <div class="col-xs-12">
                <img src="/images/uploads/sample_profile.jpg" class="img-responsive img-circle center-block">
            </div>
            <div class="col-xs-12">
                <h1 class="text-center">{{ $user->username }}</h1>
            </div>
            <div class="col-xs-offset-3 col-xs-6 text-center">
                <span><i class="fa fa-birthday-cake" aria-hidden="true"></i>&nbsp;15.02.1992</span>
            </div>
            <div class="col-xs-6 text-center">
                <span class="friends_status">You are not friends!</span>
            </div>
            <div class="col-xs-6 text-center">
                <span class="friends_status">{{ $user->prename }} has 322 friends.</span>
            </div>
            <div class="col-xs-6 text-center">
                <button class="btn btn-default profile_button">Send a Friend Request</button>
            </div>
            <div class="col-xs-6 text-center">
                <button class="btn btn-default profile_button">Write {{ $user->prename }} a Message</button>
            </div>
        </div>

    </div>

@endsection