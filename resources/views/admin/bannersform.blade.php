@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row admin-panel">
        <div class="col-md-8 col-md-offset-2">
            <form action="/newbanner" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}                             
                <div class="form-group">
                    <label>Ներբեռնել գլխավոր նկարը</label>
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