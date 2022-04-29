@extends('admin.master')


@section('body')
    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" enctype="multipart/form-data" action="{{ route('admin.about.update', ['id'=> $request->id]) }}" method="POST">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12">
                                            <label>ชื่อเมนู</label>
                                            <input type="text" name="title" placeholder="ชื่อเมนู" class="form-control form-control-line" value="{{ $request->title }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" value="1" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" {{ $request->type == "1" ? "checked": "" }}>
                                                <label class="custom-control-label" for="customRadioInline1">เลือกจากหมวดหมู่</label>
                                              </div>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" value="2" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" {{ $request->type == "2" ? "checked": "" }}>
                                                <label class="custom-control-label" for="customRadioInline2">ใส่เป็น URL</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="category_display" style="display: {{ $request->type == "1" ? "block" : "none" }}">
                                        <div class="col-sm-12">
                                            <label for="exampleFormControlSelect1">เลือกหมวดหมู่</label>
                                            <select class="form-control" name="category_select" id="category_select">
                                                @foreach($category as $key)
                                                    <option value="{{ $key->id }}" {{ $request->type == "1" ? ($request->description == $key->id ? "selected" : ""): "" }}>{{ $key->title_category_eng." ".$key->title_category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="url_display" style="display: {{ $request->type == "2" ? "block" : "none" }}">
                                        <div class="col-sm-12">
                                            <label for="exampleFormControlInput1">ใส่ URL Example https://google.com/</label>
                                            <input type="text" name="url_select" class="form-control" id="exampleFormControlInput1" placeholder="ใส่ URL" value="{{ $request->type == "2" ? $request->description : "" }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="exampleFormControlInput1">SEO dofollow | nofollow</label>
                                            <select name="rel" class="form-control">
                                                <option value="1" {{ $request->rel == "1" ? "selected" : "" }}>dofollow</option>
                                                <option value="0" {{ $request->rel == "0" ? "selected" : "" }}>nofollow</option>
                                            </select>
                                        </div>
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            $("input[name='customRadioInline1']").change(function(){
                                                if($(this).val() == "1")
                                                {
                                                    $("#category_display").show();
                                                    $("#url_display").hide();
                                                }
                                                if($(this).val() == "2")
                                                {
                                                    $("#category_display").hide();
                                                    $("#url_display").show();
                                                }
                                            });
                                        });
                                    </script>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success btn-lg" type="submit">แก้ไขเมนู</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>

                    </script>
@endsection
