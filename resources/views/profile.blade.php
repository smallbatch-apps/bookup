@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-8">

        <h2>{{$profile->title}}</h2>

        <h4>Summary</h4>
        {{$profile->summary}}
        <br><br>

        <h4>Description</h4>
        {{$profile->description}}
        <br><br>

        <h4>Location</h4>

        <p>Location data is never made public, only an approximate distance.</p>

        @if($profile->location)
            <LocationMap location="{{$profile->location}}" />
        @endif

    </div>
    <div class="col">

        <a class="btn btn-block btn-lg btn-outline-primary" href="{{route('profile.edit')}}"><i class="fa fa-user-circle"></i> Edit your profile</a>

        <br>

        <div class="card">
            <div class="card-body">
                <h4>Your favourite books</h4>

                <p style="margin-bottom: 0">The books you like will help you match with someone.</p>
            </div>

            <ul class="list-group list-group-flush">
            @foreach($profile->likedBooks as $book)
                <li class="list-group-item">{{$book->title}} by {{$book->author}}</li>
            @endforeach
            </ul>
        </div>
        <br>

        <div class="card">
            <div class="card-body">
                <h4>Books You hate</h4>

                <p style="margin-bottom: 0">These books are a red flag for you, and anyone who likes these books will probably not be a match.</p>
            </div>

            <ul class="list-group list-group-flush">
            @foreach($profile->hatedBooks as $book)
                <li class="list-group-item">{{$book->title}} by {{$book->author}}</li>
            @endforeach
            </ul>
        </div>

    </div>

</div>

@endsection