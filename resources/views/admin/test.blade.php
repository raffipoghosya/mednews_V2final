@extends('layouts.app')

@section('content')
    <div class="container">
            <div class="content">
                    <div class="component">
                            <div class="overlay">
                                    <div class="overlay-inner">
                                    </div>
                            </div>
                            <img class="resize-image" src="images/posts/{{$post->img}}">
                            <button class="btn-crop js-crop">Պահպանել<img class="icon-crop" src="img/crop.svg"></button>
                    </div>				
            </div><!-- /content -->

    </div> <!-- /container -->
@endsection


