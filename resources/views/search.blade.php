<!DOCTYPE html>
<html>
    <head>
        <title>MedNews</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/images/fav.png" type="image/x-icon">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row header">
                <div class="col-md-4">
                    <a href="/"><img src="images/logo.png" alt=""/></a>
                </div>
                <div class="col-md-8 text-right">
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
                            <ul class="mobile-nav">
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
            <div class="row searchbar">
                <div class="col-md-12">
                    <form action="/search" method="post" class="searchform">
                        {{ csrf_field() }}
                        <div class="input-group text-right">
                            <input type="text" name="search" class="form-control" placeholder="Որոնել">
                            <button type="submit" class="btn mybtn"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row banner" style="height:auto!important;">
                @foreach($posts as $post)
                <div class="col-md-2 col-xs-4 section" style="height:250px;position: relative;overflow: hidden;padding:0 5px;"><a href="/single/{{$post->id}}" style="color:black;text-decoration:none;">
                    <div class="sectimg-area" style="background:url('../images/posts/{{$post->img}}') no-repeat;margin-bottom:10px;"></div>
                    <div style="margin-bottom:10px;font-size:12px;margin-bottom:5px;"><b>{{$post->title}}</b></div>
                </a></div>
                @endforeach
            </div>     
            <div class="clearfix"></div>
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
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>
