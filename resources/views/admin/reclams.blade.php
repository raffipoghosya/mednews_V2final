@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row admin-panel">
        @foreach($reclams as $reclam)
        <div class="col-md-4 section">
            <img style='height:200px;' src="images/reclam/{{$reclam->img}}" class="img-responsive" alt=""/>
            <p><a href="{{$reclam->href}}">{{$reclam->href}}</a></p>
            <p>Տեղը՝{{$reclam->type}}</p>
            @if($reclam->page == 'single')
            <p>Գովազդը գտնվում է ներքին էջում</p>
            @else
            <p>Գովազդը գտնվում է առաջին էջում</p>
            @endif
            <p>
                <a style="color:white;" class="btn btn-danger delete" href="/deletereclam/{{$reclam->id}}">Ձնջել</a>
            </p>
        </div>
        @endforeach
    </div>    
</div>
@endsection