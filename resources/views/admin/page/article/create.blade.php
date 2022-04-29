@extends('admin.master')


@section('body')
<link rel="stylesheet" href="{{ asset('minified/themes/default.min.css') }}">
<script src="{{ asset('minified/sceditor.min.js') }}"></script>
    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" enctype="multipart/form-data" action="{{ route('admin.article.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12">
                                            <label>หัวข้อ</label>
                                            <input type="text" name="title" placeholder="ชื่อเรื่อง" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <textarea name="description" id="example" rows="15" cols="150"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="exampleFormControlFile1">ปกบทความ</label>
                                                <input type="file" class="form-control-file" name="file" id="exampleFormControlFile1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <button class="btn btn-success btn-lg" type="submit">เพิ่มบทความ</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                        // Replace the textarea #example with SCEditor
                        var textarea = document.getElementById('example');
                        sceditor.create(textarea, {
                            style: '{{ asset("minified/themes/content/default.min.css") }}'
                        });
                    </script>
@endsection
