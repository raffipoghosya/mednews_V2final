@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row admin-panel">
        <div class="col-md-8 col-md-offset-2">
            <form action="/savevideo" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" name="title" placeholder="Վերնագիր" value="{{$video->title}}" required>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="iframe" rows="10" placeholder="Տեղադրել հղումը Youtube-ից" required>{{$video->iframe}}</textarea>
                </div>                
                <div class="form-group">
                    <textarea class="form-control" name="description" rows="10" placeholder="Կարճ նկարագիր" required>{{$video->description}}</textarea>
                </div>                
                <div class="form-group">
                    <p class="small text-info">Գլխավոր նկարը`</p>   
                    <img width="200" src="/images/videos/{{$video->img}}" class="img-responsive">
                    <label>Ներբեռնել գլխավոր նկարը</label>
                    <input type="file" class="form-control" name="img">
                </div>              
                <div class="form-group">
                    <input type="hidden" name="id" value="{{$video->id}}">
                    <input type="hidden" name="hiddenimg" value="{{$video->img}}">
                    <input type="submit" class="btn btn-success" value="Պահպանել">
                    <input type="reset" class="btn btn-danger" value="Չեղարկել">
                </div>
            </form>
        </div>
    </div>    
</div>
@endsection