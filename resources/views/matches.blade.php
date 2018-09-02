@extends('layouts.app')



@section('content')


<div class="requirements">
    <div class="row">
        <div class="col-md-6">
            <h4>Based on your profile requirements</h4>

            <p>You are a <em>{{$profile->gender->gender}}</em> looking for a
                <em>{{implode(' or ', $profile->seeking->pluck('gender')->toArray())}}</em>
            </p>

        </div>
        <div class="col-md-3">
            <h4>Books you like</h4>

            <ul class="list-group">
                @foreach($profile->likedBooks as $book)
                <li class="list-group-item">{{$book->title}}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-3">
            <h4>Books you hate</h4>

            <ul class="list-group">
                @foreach($profile->hatedBooks as $book)
                    <li class="list-group-item">{{$book->title}}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<br><br>
<div class="matches">
    @foreach($matches as $matchRow)
        <div class="card-deck">
            @foreach($matchRow as $match)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$match['_source']['title']}}</h5>
                        <p class="card-text">{{$match['_source']['summary']}}</p>
                        <p class="card-text">Gender: {{$match['_source']['gender_value']}}</p>
                        <p class="card-text">Distance: {{$match['_source']['distance']}}km</p>
                    </div>

                    @if(count($match['_source']['book_preference_likes']))
                        <h5 class="card-title" style="margin-left: 15px; margin-top: 20px;">Likes These Books</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($match['_source']['book_preference_likes'] as $book)
                        <li class="list-group-item">{{$book}}</li>
                        @endforeach
                    </ul>
                    @endif

                    @if(count($match['_source']['book_preference_hates']))
                        <h5 class="card-title" style="margin-left: 15px; margin-top: 20px;">Hates These Books</h5>
                        <ul class="list-group list-group-flush">
                            @foreach($match['_source']['book_preference_hates'] as $book)
                                <li class="list-group-item">{{$book}}</li>
                            @endforeach
                        </ul>
                    @endif


                    <div class="card-footer">
                        <a href="{{route('match.show', $match['_source']['id'])}}" class="btn btn-primary pull-right">View Profile</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection