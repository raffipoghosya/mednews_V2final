@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row admin-panel">
        <div class="col-md-12 text-center">
            <div class="col-md-4">
                <p class="bg-primary">Հայտարարությունը ընտրված է</p>
            </div>
            <div class="col-md-4">
                <p class="bg-success">Հայտարարությունը հրապարակված է</p>
            </div>
            <div class="col-md-4">
                <p class="bg-danger">Հայտարարությունը հրապարակված չէ</p>
            </div>
        </div>
        <div class="col-md-2 col-md-offset-5">
            <form action="/adsearch" method="post" class="searchform" style="width:100%;">
                {{ csrf_field() }}
                <div class="input-group text-right" style="width:100%;">
                    <input type="text" name="adsearch" class="form-control" placeholder="Փնտրել">
                    <button type="submit" class="btn mybtn"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </form>            
        </div>
        <div class="clearfix"></div><br/>
        <table class="table">
            <tr>
                <td>Հերթական համարը</td>
                <td>Նկար</td>
                <td>Վերնագիր</td>
                <td>Բաժին</td>
                <td>Ամսաթիվ</td>
                <td>Դիտումներ</td>
                <td>Կառավարում</td>
            </tr>
            @if($search != 'noresult')
            @foreach($search as $post)
                @if($post->selected == '1')
                <tr class="bg-primary">
                @elseif($post->published == '1')
                <tr class="bg-success">
                @else
                <tr class="bg-danger">
                @endif      
                <td>{{$post->id}}</td>
                <td><img src="images/posts/{{$post->img}}" width="100" alt=""/></td>
                <td>{{$post->title}}</td>
                <td>{{$post->category->name}}</td>
                <td>{{$post->date}}</td>
                <td>{{$post->votes}}</td>
                <td>
                    @if($post->selected == '1')
                        <a style="color:white;" class="btn btn-warning" href="/setunselected/{{$post->id}}">Անջատել ընտրվածը</a>
                    @else
                        <a style="color:white;" class="btn btn-info" href="/setselected/{{$post->id}}">Դարձնել գլխավոր</a>
                    @endif                
                    <a style="color:white;" class="btn btn-danger delete" href="/deletepost/{{$post->id}}">Ջնջել</a>
                    <a style="color:white;" class="btn btn-primary" href="/admineditpost/{{$post->id}}">Փոփոխել</a>
                </td>
            </tr>
            @endforeach
            @else
            @foreach($posts as $post)
                @if($post->selected == '1')
                <tr class="bg-primary">
                @elseif($post->published == '1')
                <tr class="bg-success">
                @else
                <tr class="bg-danger">
                @endif       
                <td>{{$post->id}}</td>
                <td><img src="images/posts/{{$post->img}}" width="100" alt=""/></td>
                <td>{{$post->title}}</td>
                <td>{{$post->category->name}}</td>
                <td>{{$post->created_at}}</td>
                <td>{{$post->votes}}</td>
                <td>
                    @if($post->selected == '1')
                        <a style="color:white;" class="btn btn-warning" href="/setunselected/{{$post->id}}">Անջատել ընտրվածը</a>
                    @else
                        <a style="color:white;" class="btn btn-info" href="/setselected/{{$post->id}}">Դարձնել գլխավոր</a>
                    @endif                
                    <a style="color:white;" class="btn btn-danger delete" href="/deletepost/{{$post->id}}">Ջնջել</a>
                    <a style="color:white;" class="btn btn-primary" href="/admineditpost/{{$post->id}}">Փոփոխել</a>
                </td>
            </tr>
            @endforeach   
            @endif
        </table>        
    </div>    
</div>
@endsection