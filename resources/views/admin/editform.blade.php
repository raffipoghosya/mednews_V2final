@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row admin-panel">
        <a href="/adminallposts" class="pull-left btn btn-default"> << Բոլոր նյութերը</a>
        <div class="clearfix"></div>
        <div class="col-md-8 col-md-offset-2">
            <form action="/savepost" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" name="title" placeholder="Վերնագիր" value="{{$post->title}}" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="anons" placeholder="Կարճ նկարագրություն" value="{{$post->anons}}" required>
                </div>
                <div class="form-group">
                    <textarea class="form-control summernote" name="description" rows="15" placeholder="Մանրամասն նկարագիր" required>{{$post->description}}</textarea>
                    <p class='small text-danger'>Տեքստի մեջ նկար չի կարելի բեռնել, պետք է նախորոք բեռնել տեսասրահում և օգտվել insert image կնոպկից</p>
                </div>                
                <div class="form-group">
                    <input type="number" class="form-control" name="votes" placeholder="Ավելացնել դիտումներ" value="{{$post->votes}}">
                </div>                 
                <div class="form-group">
                    <input type="date" class="form-control" name="date" value="{{$post->date}}">
                    <p class='smalldate' style='width:200px;height:14px;'>Հայտարարության ամսաթիվը՝ {{$post->date}}</p>
                </div>                 
                <div class="form-group">
                    <p class="small text-info">Գլխավոր նկարը`</p>   
                    <img src="/images/posts/{{$post->img}}" width='300' class="img-responsive">
                    <label>Փոխել գլխավոր նկարը</label>
                    <input type="file" class="form-control" name="img">
                </div>                
                <div class='form-group'>
                    <p class="small text-info">Տեսասրահի նկարները`</p>  
                    @foreach($gals as $gal)
                        @if($gal)
                        <div class="col-md-3 text-center" style="position: relative;height: 400px;overflow: hidden;">
                            <a href="/deletegal/{{$post->id}}/{{$gal}}" class="btn btn-danger delete" style="position: absolute;top:0;left:0;z-index: 999;color:white;">X</a>
                            <img src="/images/posts/{{$gal}}" class="img-responsive">
                            <p style="word-break: break-all;">http://mednews.am/images/posts/{{$gal}}</p>
                        </div>
                        @else
                        <span class="bg-danger">Տեսասրահում նկարներ չկան</span><br/>
                        @endif
                    @endforeach                    
                    <div class="clearfix"></div>
                    <label>Ներբեռնել տեսասրահի նոր նկարները</label><br/>
                    <span id="upfile" class='btn btn-info' style="cursor:pointer; color: white;">Ներբեռնել նկարները</span>
                    <input type="file" id="gallery-photo-add"  name="images[]" style='display: none;'  multiple/>
                    <span class='btn btn-danger' onclick="erase();">clear</span>
                    <div id='erase-area' class="gallery upgallery"></div>
                </div>              
                <div class="form-group">
                    @if($post->top == 1)
                    <label>Տեղադրել հայտարարությունը թոփում?
                        <input type="checkbox" name="top" value="1" checked></label>
                    @else
                    <label>Տեղադրել հայտարարությունը թոփում?
                        <input type="checkbox" name="top" value="1"></label>
                    @endif
                </div>
                <div class="form-group">
                    @if($post->published == 1)
                    <label>Հրապարակել?
                        <input type="checkbox" name="published" value="1" checked></label>
                    @else
                    <label>Հրապարակել?
                        <input type="checkbox" name="published" value="1"></label>
                    @endif
                </div>
                <div class="form-group">
                    @if($post->slide == 1)
                    <label>Ցուցադրել սլայդը?
                        <input type="checkbox" name="slide" value="1" checked></label>
                    @else
                    <label>Ցուցադրել սլայդը?
                        <input type="checkbox" name="slide" value="1"></label>
                    @endif
                </div>
                <div class="form-group">
                    <label>Ընտրել բաժինը</label>
                    <select class="form-control" name="cat">
                        <option class="text-success" value="{{$post->category->id}}">{{$post->category->name}}</option>
                        @foreach($cats as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Ընտրել 2-րդ բաժինը</label>
                    <select class="form-control" name="new_cat">
                        @if($choosen != null)
                            <option class="text-success" value="{{$choosen->id}}">{{$choosen->name}}</option>
                        @else
                        <option class="text-success" value="0">Ընտրել</option>
                        @endif
                        @foreach($cats as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="hidden" name="id" value="{{$post->id}}">
                    <input type="hidden" name="hiddenimg" value="{{$post->img}}">
                    <input type="hidden" name="hiddengal" value="{{$post->gallery}}">
                    <input type="submit" class="btn btn-success" value="Պահպանել">
                    <input type="reset" class="btn btn-danger" value="Չեղարկել">
                </div>
            </form>
        </div>
    </div>    
</div>
@endsection