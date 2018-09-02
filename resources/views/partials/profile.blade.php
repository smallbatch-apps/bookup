@extends('layouts.app')

@section('content')

    <h2>{{$profile->title}}</h2>


<div class="row">

    <div class="col-md-8">
    <section>
        <h4>Summary</h4>
        <p>{{$profile->summary}}</p>
    </section>

    <section>
        <h4>Description</h4>
        <p>{{$profile->description}}</p>
    </section>


    <section>
        <h4>Looking For</h4>

        <ul class="list-group">
        @foreach ($profile->seeking as $seek)
            <li class="list-group-item">{{$seek->gender}}</li>
        @endforeach
        </ul>
    </section>


    </div>
    <div class="col-md-4">
        <a class="btn btn-primary btn-block" href="{{route('matches')}}" style="margin-bottom: 20px;"><i class="fa fa-users"></i> Back to Matches</a>

        <ProfileConversation conversationId="{{$conversationId}}" profileId="{{$profile->id}}" />

    </div>


</div>

@endsection