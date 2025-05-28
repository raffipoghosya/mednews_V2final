@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row admin-panel">
        <div class="col-md-8 col-md-offset-2">
            <form action="/newvideo" id="form-id" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" name="title" placeholder="Վերնագիր" required>
                </div>
                <div class="form-group">
                    <label>Տեղադրել հղումը Youtube-ից iframe  հղում</label>
                    <textarea class="form-control" name="iframe" rows="15" placeholder="Տեղադրել հղումը Youtube-ից iframe  հղում" required></textarea>
                </div>                
                <!-- <div class="form-group">
                    <label>Կարճ նկարագիր</label>
                    <textarea class="form-control" name="description" rows="15" placeholder="Կարճ նկարագիր" required></textarea>
                </div>                 -->
                <div class="form-group">
                    <label>Ներբեռնել գլխավոր նկարը</label>
                    <input type="file" class="form-control" name="img" required>
                </div>              
                <div class="form-group">
                    <input type="submit" onclick="document.getElementById('form-id').submit();" class="btn btn-success" value="Ավելացնել">
                    <input type="reset" class="btn btn-danger" value="Չեղարկել">
                </div>
            </form>
        </div>
    </div>    
</div>
@endsection