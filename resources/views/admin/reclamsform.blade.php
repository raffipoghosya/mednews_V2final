@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row admin-panel">
        <div class="col-md-8 col-md-offset-2">
            <form action="/newreclam" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" name="href" placeholder="Հղումը" required>
                </div>     
                <div class="form-group">
                    <select name="type" class="form-control">
                        <option value="">Ընտրել</option>
                        <option value="top">Վերևում</option>
                        <option value="bottom">Ներքևում</option>
                    </select>
                </div>               
                <div class="form-group">
                    <select name="page" class="form-control">
                        <option value="">Ընտրել</option>
                        <option value="index">Առաջին էջ</option>
                        <option value="single">Ներքին էջ</option>
                    </select>
                </div>               
                <div class="form-group">
                    <label>Ներբեռնել գովազդի նկարը</label>
                    <input type="file" class="form-control" name="img" required>
                </div>              
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Ավելացնել">
                    <input type="reset" class="btn btn-danger" value="Չեղարկել">
                </div>
            </form>
        </div>
    </div>    
</div>
@endsection