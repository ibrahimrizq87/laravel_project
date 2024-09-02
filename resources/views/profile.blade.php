@extends('layouts.app');


@section('content')

<div class="container">
    <div class="row">
        <!--Profile-->
        <div class="col-12 col-md-4">
            <div class="card-header">Profile</div>
            <div class="card bg-white text-center">

                <div class="card-body">
                    <h5 class="card-title py-3">Name: {{$user->name}}</h5>
                    <h6 class="card-title text-start">E-mail: {{$user->email}}</h6>
                </div>

            </div>
            <!--Applications-->
            <div class="col-12 col-md-8">
                <div class="card bg-white">
                    <div class="card-header">
                        <h5 class="card-title">Your Applications</h5>
                    </div>

                   
                </div>
            </div>
        </div>

        @endsection