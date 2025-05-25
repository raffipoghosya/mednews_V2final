<!DOCTYPE html>
<html>
    <head>
        <title>MedNews</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/images/fav.png" type="image/x-icon">
        <meta property="og:title" content="{{$post->title}}"/>
        <meta property="og:anons" content="{{$post->anons}}"/>
        <meta property="og:image" content="http://mednews.am/public/images/posts/{{$post->img}}"/>        
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
            </div><br/>
            <div class="row single">
                <div class="mycont">
                    <div class="col-md-3 hidden-for-mobile">
                        <div class="col-md-12 text-left sect-title">Լրահոս</div>
                        <div class="latest" style="height: 500px;">
                        @foreach($latest as $last)
                        <div class="last" style="height: 98px;overflow: hidden;">
                            <a href='/single/{{$last->id}}'>
                                <div class="last-imgarea text-center">
                                    <img src="/images/posts/{{$last->img}}" class="img-responsive" alt=""/>
                                </div>
                                <div class="last-content">
                                    <div class="smalldate">{{$last->date}}</div>
                                    <div style="font-size:12px;"><b>{{$last->title}}</b></div>
                                </div>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                        @endforeach
                        </div>
                        <br/>
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
                    </div>
                    <style>
                        .single-content p{color:black!important;font-size:17px!important;}
                        .single-content p span{color:black!important;font-size:17px!important;}
                    </style>
                    <div class="col-md-6 new-padding" style="background: #f6f7f9;">
                        <div class="single-content">
                            <p style="font-size:22px!important;text-align:center"><b>{{$post->title}}</b></p>
                            <img src="/images/posts/{{$post->img}}" class="img-responsive" alt=""/>
                            <p>{!!$post->description!!}</p>
                        </div>
                        @if($post->slide == 1)
                            @if(count($gals) > 1)
                            <div class='row'>
                                <div id="main_area">
                                    <!-- Slider -->
                                    <div class="row">
                                        <div class="col-xs-12" id="slider">
                                            <!-- Top part of the slider -->
                                            <div class="row">
                                                <div class="col-sm-12" id="carousel-bounding-box">
                                                    <div class="carousel slide" id="myCarousels">
                                                        <!-- Carousel items -->
                                                        <div class="carousel-inner">
                                                            <div class="active item" data-slide-number="0">
                                                                <img src="/images/posts/{{$gals[0]}}"></div>
                                                            @foreach($gals as $key => $gal)
                                                            @if($key != 0)
                                                            <div class="item" data-slide-number="{{$key}}">
                                                                <img src="/images/posts/{{$gal}}"></div>
                                                            @endif
                                                            @endforeach                                                        
                                                        </div><!-- Carousel nav -->
                                                        <a class="left carousel-control" href="#myCarousels" role="button" data-slide="prev">
                                                            <span class="glyphicon glyphicon-chevron-left"></span>                                       
                                                        </a>
                                                        <a class="right carousel-control" href="#myCarousels" role="button" data-slide="next">
                                                            <span class="glyphicon glyphicon-chevron-right"></span>                                       
                                                        </a>                                
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--/Slider-->
                                    <div class="row hidden-xs" id="slider-thumbs">
                                        <!-- Bottom switcher of slider -->
                                        <ul class="hide-bullets">
                                            @foreach($gals as $key => $gal)
                                            <li class="col-sm-2">
                                                <a class="thumbnail" id="carousel-selector-{{$key}}"><img style="height:60px;" src="/images/posts/{{$gal}}"></a>
                                            </li>
                                            @endforeach                                        
                                        </ul>                 
                                    </div>
                                </div>
                            </div>
                            @else
                            <img width="100%" src="/images/posts/{{$gals[0]}}">
                            @endif
                        @endif
                        <div class="clearfix"></div>
                        <br/><br/>
                        <div class="col-md-12 text-left sect-title">{{$post->category->name}}</div>
                        @foreach($recomented as $rec)
                        <div class="col-md-12 newresponse">
                            <a href="/single/{{$rec->id}}" style="color:black;">
                            <div class="last">
                                <div class="col-md-4 text-center">
                                    <img src="/images/posts/{{$rec->img}}" class="img-responsive" alt=""/>
                                </div>
                                <div class="col-md-8">
                                    <p class="smalldate">{{$rec->date}}</p>
                                    <div style="font-size:12px;"><b>{{$rec->title}}</b></div>
                                    <div class="large-text">{!!$rec->anons!!}</div>
                                </div>
                            </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-md-3">
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
                        <div class="col-md-12 text-left sect-title" style="padding-left:0;">Առավել ընթերցված</div>
                        @foreach($mostviewed as $most)
                        <div class="col-md-12 vertical-sect mymostviewed">
                            <a href="/single/{{$most->id}}">
                                <img src="/images/posts/{{$most->img}}" alt=""/>
                                <div style="font-size:12px;"><b>{{$most->title}}</b></div>
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
        <script>
          jQuery(document).ready(function($) {
 
                $('#myCarousels').carousel({
                        interval: 5000
                });

                $('#carousel-text').html($('#slide-content-0').html());

                //Handles the carousel thumbnails
               $('[id^=carousel-selector-]').click( function(){
                    var id = this.id.substr(this.id.lastIndexOf("-") + 1);
                    var id = parseInt(id);
                    $('#myCarousels').carousel(id);
                });


                // When the carousel slides, auto update the text
                $('#myCarousels').on('slid.bs.carousel', function (e) {
                         var id = $('.item.active').data('slide-number');
                        $('#carousel-text').html($('#slide-content-'+id).html());
                });
        });
        </script>
        <script>
        $(function(){
            $('.carousel').carousel({
              interval: 5000
            });
        });
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>
