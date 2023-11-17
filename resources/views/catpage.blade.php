<!DOCTYPE html>
<html>
    <head>
        <title>MedNews</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/images/fav.png" type="image/x-icon">        
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="/css/style.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row header">
                <div class="mycont">
                    <div class="col-md-3">
                        <a href="/"><img src="/images/logo.png" alt=""/></a>
                    </div>
                    <div class="col-md-9 text-right">
                        <ul class="menu-nav">
                            @foreach($cats as $cat)
                            @if($cat->menu == '1')
                            <li><a href="/catpage/{{$cat->id}}"><i class="fa fa-circle" aria-hidden="true"></i>{{$cat->name}}</a></li>
                            @endif
                            @endforeach
                        </ul>
                        <div class="dropdown mobile-nav">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu mymobile" aria-labelledby="dropdownMenuButton">
                                <ul>
                                    @foreach($cats as $cat)
                                    @if($cat->menu == '1')
                                    <li><a href="/catpage/{{$cat->id}}">{{$cat->name}}</a></li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row searchbar">
                <div class="mycont">
                    <div class="col-md-12">
                        <form action="/search" method="post" class="searchform">
                            <div class="input-group text-right">
                                <input type="text" name="search" class="form-control" placeholder="Որոնել">
                                <button type="submit" class="btn mybtn"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
            <div class="row single">
                <div class="mycont">
                    <div class="col-md-3">
                        <div class="col-md-12 text-left sect-title">Լրահոս</div>
                        <div class="latest" style="height: 500px;">
                        @foreach($latest as $last)
                        <div class="last" style="height: 98px;overflow: hidden;">
                            <a href='/single/{{$last->id}}'>
                                <div class="last-imgarea text-center">
                                    <img src="/images/posts/{{$last->img}}" class="img-responsive" alt=""/>
                                </div>
                                <div class="last-content">
                                    <p class="smalldate">{{$last->date}}</p>
                                    <div style="font-size:12px"><b>{{$last->title}}</b></div>
                                    <div class="small last-text">{{$last->anons}}</div>
                                </div>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                        @endforeach
                        </div>
                        <div class="col-md-12 vertical-sect">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active">
                                    @foreach($reclamtops as $key => $reclam)
                                    @if($key == 0)
                                    <a href="{{$reclam->href}}">
                                        <img src="/images/reclam/{{$reclam->img}}" class="img-responsive" alt=""/>
                                    </a>
                                    @endif
                                    @endforeach
                                </div>
                                @foreach($reclamtops as $key => $reclam)
                                    @if($key != 0)
                                    <div class="item">
                                        <a href="{{$reclam->href}}">
                                            <img src="/images/reclam/{{$reclam->img}}" class="img-responsive" alt=""/>
                                        </a>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-6">                        
                        <div class="col-md-12 text-left sect-title">{{$cattitle->name}}</div>
                        @if($cattitle->id != 8)
                            @foreach($recomented as $rec)
                            <div class="col-md-12 newresponse">
                                <a href="/single/{{$rec->id}}" style="color:black;">
                                <div class="last">
                                    <div class="col-md-4 text-center">
                                        <img src="/images/posts/{{$rec->img}}" class="img-responsive" alt=""/>
                                    </div>
                                    <div class="col-md-8">
                                        <p class="smalldate">{{$rec->date}}</p>
                                        <div style="font-size:12px"><b>{{$rec->title}}</b></div>
                                        <p class="large-text">{{$rec->anons}}</p>
                                    </div>
                                </div>
                                </a>
                            </div>
                            @endforeach
                        @else
                            @foreach($videos as $video)
                            <div class="col-md-6 text-left" data-toggle="modal" data-target="#myModal{{$video->id}}" style="cursor: pointer;height: 220px;margin-bottom:40px;">
                                <div class="sectimg-area" style="background:url('../images/videos/{{$video->img}}') no-repeat;"></div>
                                <div class="video-title">
                                    <div>{!!$video->title!!}</div>
                                    <!--<div class="small last-text">{!!$video->description!!}</div>-->
                                </div>
                            </div>
                            <div id="myModal{{$video->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
        
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">{{$video->title}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>{!!$video->iframe!!}</p>
                                        </div>
                                    </div>
        
                                </div>
                            </div>
                            @endforeach
                        @endif
                        <div class="row text-center">{!! $recomented->links(); !!}</div>
                    </div>
                    <div class="col-md-3">
                        <div class="col-md-12 vertical-sect">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        @foreach($reclambottoms as $key => $reclam)
                                        @if($key == 0)
                                        <a href="{{$reclam->href}}">
                                            <img src="/images/reclam/{{$reclam->img}}" class="img-responsive" alt=""/>
                                        </a>
                                        @endif
                                        @endforeach
                                    </div>
                                    @foreach($reclambottoms as $key => $reclam)
                                    @if($key != 0)
                                    <div class="item">
                                        <a href="{{$reclam->href}}">
                                            <img src="/images/reclam/{{$reclam->img}}" class="img-responsive" alt=""/>
                                        </a>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-left sect-title" style="padding-left:0;">Առավել ընթերցված</div>
                        @foreach($mostviewed as $most)
                        <div class="col-md-12 vertical-sect mymostviewed">
                            <a href="/single/{{$most->id}}">
                                <img src="/images/posts/{{$most->img}}" alt=""/>
                                <div style="font-size:12px"><b>{{$most->title}}</b></div>
                            </a>
                        </div>
                        @endforeach                    
                    </div>
                </div>
            </div>     
            <div class="row footer text-center">                
                <img src="/images/logo.png" alt=""/>
                <div class="col-md-12 text-center footer-menu">
                    <ul class="menu-nav">
                        @foreach($cats as $cat)
                        @if($cat->menu == '1')
                        <li><a href="/catpage/{{$cat->id}}"><i class="fa fa-circle" aria-hidden="true"></i>{{$cat->name}}</a></li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>
