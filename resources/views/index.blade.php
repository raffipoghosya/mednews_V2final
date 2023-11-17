<!DOCTYPE html>
<html>
    <head>
        <title>MedNews</title>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-TJVXTQT');</script>
        <!-- End Google Tag Manager -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/images/fav.png" type="image/x-icon">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <meta name="keyword" content="mednews, մեդնյուզ բժշկական, բժշկություն, նորություններ, բժշկական նորություններ, առողջություն, առողջապահություն, առողջապահական համակարգ, բժիշկ, ախտորոշում, բուժում, հիվանդություն, քաղցկեղ, հետազոտություն, խորհրդատվություն, մասնագետ,   էսթետիկ բժշկություն, իմ բժիշկը,  med, medical, bjshkutyun, aroxjutyun, axtoroshum, bujum, hetazotutyun, doctor, doctors, endokrin virabuyj, sirt-anotayin, plastic virabuyj, srtaban, vnasvacqaban, naxanshan, revmatolog, ortoped, virabuyj, վիրաբուժ, վիրահատություն, լապարասկոպիկ, էնդոսկոպիկ, anotayin, անոթային վիրաբույժ, ասոցացիա, ստոմատոլոգ, ուռուցքաբանություն, ստենտավորում, քաղցկեղային, ակնաբույժ, գինեկոլոգ, ընդհանուր վիրաբույժ, հիվանդանոց, բժշկական կենտրոն, medical center, hivandanoc, hivandutyun, hivand, pacient, bjshkakan kentron, stom, klinika, clinics, laborator, laboratoriA, լաբորատորիա, անալիզ, analiz, konsultacia, բժշկի կոնսուլտացիա, ուռուցք, rak, urucq, mankakan, մանկական, լուրեր, news">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TJVXTQT"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <div class="container-fluid">
            <div class="row header">
                <div class="mycont">
                    <div class="col-md-3 col-xs-3 logoarea">
                        <a href="/"><img src="images/logo.png" alt=""/></a>
                    </div>
                    <div class="col-md-9 col-xs-9 text-right">
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
            <div class="row banner">
                <div class="mycont">
                    <div class="col-md-6 col-sm-6 col-xs-12 top-banner">
                        <div class="row big-img" id="bigimg0">
                            <img src="images/posts/{{$tops[0]->img}}">
                        </div>
                        @foreach($tops as $key => $top)
                            @if($key != 0)
                            <div class="row big-img" id="bigimg{{$key}}">
                                <img src="images/posts/{{$top->img}}">
                            </div>
                            @endif
                        @endforeach                        
                        <div class="row top">
                            <div class="col-md-4 col-xs-4" id="top0">
                                <a href="/single/{{$tops[0]->id}}">
                                    <p class="small smalldate">{{$tops[0]->date}}</p>
                                    <p>{{$tops[0]->title}}</p>
                                </a>
                            </div>
                            @foreach($tops as $key => $top)
                            @if($key != 0)
                            <div class="col-md-4 col-xs-4" id="top{{$key}}">
                                <a href="/single/{{$top->id}}">
                                    <p class="small smalldate">{{$top->date}}</p>
                                    <p>{{$top->title}}</p>
                                </a>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12 selectedblock">
                        <div class="row section">
                            <div class="col-md-12 vertical-sect">
                                <a href="/single/{{$selected->id}}">
                                    <img src="images/posts/{{$selected->img}}" class="img-responsive" alt=""/>
                                    <p style="margin-top:10px;"><b>{{$selected->title}}</b></p>
                                    <p>{!!$selected->anons!!}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12" style="height:100%;overflow: hidden;padding-top:10px;position:relative;">
                        <button id="openform" class="btn mybtn" style="position:absolute;top:10px;right:23px;"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <div class="row" style="position: absolute;top: 10px;width: 98%;">
                            <div class="col-md-12" id="noneform" style="display:none;">
                                <form action="/search" method="post" class="searchform" style="width:100%;">
                                    {{ csrf_field() }}
                                    <div class="input-group text-right" style="width:100%;">
                                        <input type="text" name="search" class="form-control" placeholder="Փնտրել">
                                        <button type="submit" class="btn mybtn"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="latest">
                            <div class="col-md-12 text-left sect-title" style="margin-top:0;">Լրահոս</div>
                            @foreach($latest as $last)
                            <div class="last">
                                <a href='/single/{{$last->id}}'>
                                <div class="last-imgarea text-center">
                                    <img src="images/posts/{{$last->img}}" class="img-responsive" alt=""/>
                                </div>
                                <div class="last-content">
                                    <div class="small smalldate">{{$last->date}}</div>
                                    <div style="font-size:12px;word-break: break-word;"><b style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 4;-webkit-box-orient: vertical;">{{$last->title}}</b></div>
                                    <!--<div class="small last-text">{!!$last->anons!!}</div>-->
                                </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row category">
                <div class="mycont">                    
                    <div class="col-md-6 col-xs-12 reclam-top-siaze">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active">
                                    <a href="#">
                                        <video width="100%" height="240" autoplay muted>
                                          <source src="images/reclam/rec.mp4" type="video/mp4">
                                        </video>
                                    </a>
                                </div>
                                @foreach($reclamtops as $key => $reclam)
                                    @if($key == 0)
                                        <div class="item">
                                            <a href="{{$reclam->href}}">
                                                <img src="images/reclam/{{$reclam->img}}" class="img-responsive" alt=""/>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                                @foreach($reclamtops as $key => $reclam)
                                    @if($key != 0)
                                        <div class="item">
                                            <a href="{{$reclam->href}}">
                                                <img src="images/reclam/{{$reclam->img}}" class="img-responsive" alt=""/>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>                        
                    <div class="col-md-6 col-xs-12 mycatsdiv">
                        <ul class="cat-nav">
                            @foreach($cats as $cat)
                            @if($cat->menu == '0')
                            <li><a href="/catpage/{{$cat->id}}"><i class="fa fa-circle" aria-hidden="true"></i>{{$cat->name}}</a></li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row sections">
                <div class="mycont">
                    <div class="mysectwidth">
                        @foreach($category as $key => $cat)
                        <div class="row section">
                            <a style="float:none;" href="/catpage/{{$cat->id}}"><div class="col-md-12 text-left sect-title">{{$cat->name}}</div></a>
                            <div class="clearfix"></div>
                                @foreach($catnews[$key] as $catnew)
                                    @if($cat->id == $catnew->category_id)
                                        <div class="col-md-4 col-xs-4 section" style="height:250px;position: relative;overflow: hidden;padding:0 5px;"><a href="/single/{{$catnew->id}}" style="color:black;text-decoration:none;">
                                            <div class="sectimg-area" style="background:url('../images/posts/{{$catnew->img}}') no-repeat;margin-bottom:10px;"></div>
                                            <div style="margin-bottom:10px;font-size:12px;margin-bottom:5px;"><b>{{$catnew->title}}</b></div>
                                            <!--<div class="large-text">{!!$catnew->anons!!}</div>-->
                                        </a></div>
                                    @endif
                                @endforeach
                        </div> 
                        @endforeach
                    </div>
                    <div class="mysectwidth">
                        <div class="row">
                            <div class="myharc">
                                <div class="row section">
                                    <div class="col-md-12 text-left sect-title">{{$topcats->name}}</div>
                                    @foreach($toppost as $post)
                                    <div class="col-md-12 vertical-sect">
                                        <a style="float: none;" href="/single/{{$post->id}}">
                                            <img src="images/posts/{{$post->img}}" class="img-responsive" style="margin-bottom:10px;" alt=""/>
                                            <div style="font-size:12px;margin-bottom:5px;"><b>{{$post->title}}</b></div>
                                            <div class="large-text" style="max-height: 130px;-webkit-line-clamp: 8;">{!!$post->anons!!}</div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mymost">
                                <div class="row">
                                    <div class="col-md-12 text-left sect-title" style="padding-left:0;">Առավել ընթերցված</div>
                                    @foreach($mostviewed as $most)
                                    <div class="col-md-12 vertical-sect mymostviewed">
                                        <a href="/single/{{$most->id}}">
                                        <img src="images/posts/{{$most->img}}" alt=""/>
                                        <div style="font-size:12px;"><b>{{$most->title}}</b></div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="row bottom-reclam">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        @foreach($reclambottoms as $key => $reclam)
                                        @if($key == 0)
                                        <a href="{{$reclam->href}}">
                                            <img src="images/reclam/{{$reclam->img}}" class="img-responsive" alt=""/>
                                        </a>
                                        @endif
                                        @endforeach
                                    </div>
                                    @foreach($reclambottoms as $key => $reclam)
                                    @if($key != 0)
                                    <div class="item">
                                        <a href="{{$reclam->href}}">
                                            <img src="images/reclam/{{$reclam->img}}" class="img-responsive" alt=""/>
                                        </a>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row calendar" style="padding-top:20px;">
                            <form action="/datesearch" method="post" class="form-inline">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type="date" name="date" data-date-inline-picker="true" class="form-control">                                
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Որոնել" style="background:#b760a5;color:white;border:1px solid #b760a5;">
                                </div>
                            </form> 
                        </div>
                            </div>
                        </div>
                        
                    </div>  
                </div>
            </div>
            <div class="row social">
                <div class="mycont">
                    <div class="col-md-6 col-md-offset-3 text-center">
                        <hr/>
                        <div class="social-bg">
                            <a href="#"><i class="fa fa-facebook-official fa-3x" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-instagram fa-3x" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gallery">
                <div class="mycont">
                    <div class="col-md-12 text-right sect-title">Տեսադարան</div>
                    <div class="clearfix"></div>
                    @foreach($videos as $video)
                    <div class="col-md-2 col-xs-6 text-left" data-toggle="modal" data-target="#myModal{{$video->id}}" style="cursor: pointer;height: 220px;">
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
                </div>
            </div>
            <div class="row footer text-center">                
                <img src="images/logo.png" alt=""/>
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
        $('#openform').click(function() {
            $('#noneform').css({
                'display': 'block'
            });
        });
        </script>
        <script>
        $(function(){
            $('.carousel').carousel({
              interval: 15000
            });
        });
        </script>
        <script>
        $(document).ready(function(){
            foo();            
        });
        function foo(){
            setTimeout(function(){
             $('#top0').addClass('active');
             $('#bigimg0').addClass('show');
        },0);

        setTimeout(function(){
             $('#top0').removeClass('active');
             $('#bigimg0').removeClass('show');
        },5000);
        

        setTimeout(function(){
             $('#top1').addClass('active');
             $('#bigimg1').addClass('show');
        },5000);

        setTimeout(function(){
             $('#top1').removeClass('active');
             $('#bigimg1').removeClass('show');
        },10000);
        

        setTimeout(function(){
             $('#top2').addClass('active');
             $('#bigimg2').addClass('show');
        },10000);

        setTimeout(function(){
             $('#top2').removeClass('active');
             $('#bigimg2').removeClass('show');
        },15000);
        
            setTimeout(foo, 15000);
        }
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>
