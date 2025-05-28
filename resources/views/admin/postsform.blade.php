@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row admin-panel">
            <div class="col-md-8 col-md-offset-2">
                <form id="form-id" action="/newpost" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" name="title" placeholder="Վերնագիր" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="anons" placeholder="Կարճ նկարագրություն" required>
                    </div>
                    <div class="form-group">
                        <textarea id="description" class="form-control summernote" name="description" rows="15"
                            placeholder="Մանրամասն նկարագիր" required></textarea>
                    </div>
                    <div class="form-group">
                        <input style="width: 28% !important" type="number" class="form-control" name="votes" placeholder="Ավելացնել դիտումներ">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" name="date">
                    </div>
                    <div class="form-group">
                        <label>Ներբեռնել գլխավոր նկարը</label>
                        <input type="file" class="form-control" name="img" required>
                    </div>
                    <div class='form-group'>
                        <label>Ներբեռնել տեսասրահի նկարները</label><br />
                        <span id="upfile" class='btn btn-info' style="cursor:pointer; color: white;">Ներբեռնել
                            նկարները</span>
                        <input type="file" id="gallery-photo-add" name="images[]" style='display: none;' multiple />
                        <span class='btn btn-danger' onclick="erase();">clear</span>
                        <div id='erase-area' class="gallery upgallery"></div>
                    </div>
                    <div class="form-group">
                        <label>ցուցադրել թոփում?
                            <input type="checkbox" name="top" value="1"></label>
                    </div>
                    <!-- <div class="form-group">
                        <label>Ցուցադրել սլայդը?
                            <input type="checkbox" name="slide" value="1"></label>
                    </div> -->
                    <div class="form-group">
                        <label>Հրապարակել?
                            <input type="checkbox" checked name="published" value="1"></label>
                    </div>

                    <div class="form-group">
                        <div class="form-group d-flex justify-content-between align-items-center">
                            <label for="norutyun" class="mb-0">Նորություն</label>
                            <input type="checkbox" name="norutyun" id="norutyun" value="1">
                        </div>
                        <div class="form-group d-flex justify-content-between align-items-center">
                            <label for="harcazruyc" class="mb-0">Հարցազրույց</label>
                            <input type="checkbox" name="harcazruyc" id="harcazruyc" value="1">
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

@section('scripts')
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                    ['help', ['help']]
                ]
            });
        });
    </script>
@endsection