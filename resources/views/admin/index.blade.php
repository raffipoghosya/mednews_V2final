@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row admin-panel">
        <div class="col-md-2 text-center ad">
            <a href="/adminsections">
                <i class="fa fa-cog fa-3x" aria-hidden="true"></i>
                <p>Բաժիններ</p>
            </a>
        </div>
        <div class="col-md-2 text-center ad">
            <a href="/adminallposts">
                <i class="fa fa-pie-chart fa-3x" aria-hidden="true"></i>
                <p>Բոլոր նյութերը</p>
            </a>
        </div>        
        <div class="col-md-2 text-center ad">
            <a href="/adminnewpost">
                <i class="fa fa-plus-square fa-3x" aria-hidden="true"></i>
                <p>Ավելացնել նյութեր</p>
            </a>
        </div>        
        <div class="col-md-2 text-center ad">
            <a href="/adminallvideo">
                <i class="fa fa-pie-chart fa-3x" aria-hidden="true"></i>
                <p>Բոլոր ՏԵՍԱԴԱՐԱՆը</p>
            </a>
        </div>  
        <div class="col-md-2 text-center ad">
            <a href="/adminnewvideo">
                <i class="fa fa-youtube fa-3x" aria-hidden="true"></i>
                <p>Ավելացնել ՏԵՍԱԴԱՐԱՆ Youtube-ից</p>
            </a>
        </div> 
        <div class="col-md-2 text-center ad">
            <a href="/adminallreclam">
                <i class="fa fa-camera fa-3x" aria-hidden="true"></i>
                <p>Բոլոր գովազդները</p>
            </a>
        </div> 
        <div class="col-md-2 text-center ad">
            <a href="/adminnewreclam">
                <i class="fa fa-camera fa-3x" aria-hidden="true"></i>
                <p>Ավելացնել գովազդ</p>
            </a>
        </div> 
         
    </div>    
</div>
@endsection