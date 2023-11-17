@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row admin-panel">
        @foreach($videos as $video)
        <div class="col-md-4 videos">
            {!!$video->iframe!!}
            <div class="video-title" style="position: relative;height:100px;overflow:hidden;">
                <div class="col-md-2">
                    <img src="images/videos/{{$video->img}}" class="img-responsive">
                </div>
                <p>{{$video->title}}</p>
                <p class="small">{!!$video->description!!}</p>
                <a href="/deletevideo/{{$video->id}}" class="btn btn-danger delete" style="position: absolute;top:0;right:0;color:white;">Ջնջել</a>
                <a href="/admineditvideo/{{$video->id}}" class="btn btn-primary" style="position: absolute;bottom:0;right:0;color:white;">Փոփոխել</a>
            </div>
        </div>
        @endforeach        
        <div class="clearfix"></div>
    </div>    
</div>
@endsection