@extends('layouts.app')

@section('content')
<form class="" action="{{route('profile.update')}}" method="POST">
<div class="row">
    @csrf
    <div class="col-8">

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control form-control-lg" value="{{$profile->title}}">
        </div>

        <div class="form-group">
            <label for="summary">Summary</label>
            <textarea name="summary" class="form-control" cols="30" rows="4">{{$profile->summary}}</textarea>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" cols="30" rows="4">{{$profile->description}}</textarea>
        </div>

        <div class="form-group">
            <label for="description">Location</label>

            <GetLocation coords="{{json_encode($coords)}}" />
        </div>

        <div>
            <button class="btn btn-outline-primary btn-lg float-right">Save Profile</button>

            <a class="btn btn-link btn-lg float-right" href="{{route('profile')}}">Cancel</a>
        </div>
    </div>
    <div class="col-4">
        <BookList type="liked"></BookList><br>
        <BookList type="hated"></BookList>
    </div>

</div>
</form>
@endsection