@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row admin-panel">
        <div class="col-md-10 col-md-offset-1">
            <table class="table">
                <tr class="info">
                    <td>Բաժնի անունը</td>
                    <td>Բաժնի վիճակը</td>
                    <td>Հերթականություն</td>
                    <td>Կառավարում</td>
                </tr>
                @foreach($cats as $cat)
                <tr>
                    <td>{{$cat->name}}</td>
                    <td>
                        @if($cat->top == 1)
                        <p class="text-danger">{{$cat->name}} բաժինը գտնվում է թոփ դաշտում:</p>
                        @elseif($cat->visible == 1)
                        <p class="text-success">{{$cat->name}} բաժինը ակտիվ է:</p>
                        @elseif($cat->visible == 0)
                        <p class="text-warning">{{$cat->name}} բաժինը պասիվ է:</p>
                        @endif
                    </td>
                    <td>
                        <form action="/saveorders" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                            <input type="hidden" name="id" class="form-control" value="{{$cat->id}}">
                            <div class="col-md-6"><input type="number" name="orders" class="form-control" value="{{$cat->orders}}"></div>
                            <div class="col-md-6"><input type="submit" class="btn btn-success" value="save"></div>
                            </div>
                        </form>
                    </td>
                    <td>
                        @if($cat->top == 1)
                        <h3 class="text-danger">ԹՈՓ</h3>                        
                        @elseif($cat->visible == 1)
                        <a href="/changesection/{{$cat->id}}"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i></a>
                        @else
                        <a href="/changesection/{{$cat->id}}"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i></a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
            <hr/>
            <div class="row">
                <h3>Թոփ բաժնի կառավարում</h3>
                <p class="small text-danger">Թոփում կարող է լինել միայն մեկ բաժին</p>
                <div class="col-md-6">
                    Այժմ Թոփում ակտիվ է <span class="text-danger">{{$top->name}}</span> բաժինը
                </div>
                <div class="col-md-6">
                    <p>Փոխել թոփ բաժինը</p>
                    @foreach($cats as $cat)
                    @if($cat->top == 0)
                    <p><a href="/settop/{{$cat->id}}" class="btn btn-default text-success">{{$cat->name}}</a></p>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection