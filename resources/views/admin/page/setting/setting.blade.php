@extends('admin.master')


@section('body')
    <div class="col-lg-12">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
    
                        <div class="card">
                            <div class="card-body">
                                @if(Request::get('type') == "general")
                                <form class="form-horizontal form-material" enctype="multipart/form-data" action="{{ route('admin.setting.update', ['id'=> $request->id]) }}" method="POST">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <h2>{{ $header_title }}</h2>
                                        <div class="row">
                                            <br>
                                            <br>
                                            <div class="col-md-12 col-sm-12 mb-4">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label>Title</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" name="title" placeholder="Title" class="form-control form-control-line" value="{{ $request->title }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="col-md-12 col-sm-12 mb-4">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label>Description คำอธิบายเว็บ</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" name="description" placeholder="Description" class="form-control form-control-line" value="{{ $request->description }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            @if(env('seo_full') == "1")
                                            <br>
                                            <div class="col-md-12 col-sm-12 mb-4">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label>External link</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" name="description" placeholder="External link" class="form-control form-control-line" value="{{ $request->ex_link }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="col-md-12 col-sm-12 mb-4">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label>Internal link</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" name="description" placeholder="Internal link" class="form-control form-control-line" value="{{ $request->in_link }}">
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="col-md-12 col-sm-12 mb-4">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label>Keyword</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" name="keyword" placeholder="Keyword" class="form-control form-control-line" value="{{ $request->keyword }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 mb-4">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label>LOGO</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <img src="{{ asset($request->logo) }}" style="background: #000">
                                                        <input type="file" class="form-control-file" name="file" id="exampleFormControlFile1">
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 mb-4">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label>ICON</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <img src="{{ asset($request->icon) }}" style="background: #000" width="50px">
                                                        <input type="file" class="form-control-file" name="icon" id="exampleFormControlFile1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <h3>ตั้งค่า SSL</h3>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 mb-4">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label>SSL(http or https)</label>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <select class="form-control form-control-line" name="ssl">
                                                            <option value="0" {{ $request->ssl == 0 ? 'selected' : '' }}>http://</option>
                                                            <option value="1" {{ $request->ssl == 1 ? 'selected' : '' }}>https://</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <h3>ตั้งค่า Skip โฆษณา</h3>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>วินาที </label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" name="time_skip" class="form-control form-control-line" value="{{ $request->time_skip }}">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <h3>ตั้งค่า Analytics - Header</h3>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Code </label>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea type="text" name="header" class="form-control form-control-line">{{ $request->header }}</textarea>        
                                            </div>
                                        </div>
                                        <h3>ตั้งค่า Footer</h3>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Code </label>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea type="text" name="footer" class="form-control form-control-line">{{ $request->footer }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <button class="btn btn-success btn-lg" type="submit" onclick="return confirm('ยืนยันอัพเดทข้อมูล')">อัพเดท</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @endif


                                @if(Request::get('type') == "read")
                                    <div class="form-group">
                                        <h2>{{ $header_title }}</h2>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <p>การตั้งค่า URL หนัง</p>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="radiomovie" id="radiomovie1" value="number" {{ option_get('movie_type') == "number" ? "checked" : "" }} >
                                                    <label class="form-check-label mx-4" for="radiomovie1">
                                                        แบบตัวเลข {{ url('/') }}/123456
                                                    </label>
                                                  </div>
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="radiomovie" id="radiomovie2" value="title" {{ option_get('movie_type') == "title" ? "checked" : "" }}>
                                                    <label class="form-check-label mx-4" for="radiomovie2">
                                                        แบบชื่อเรื่อง(แนะนำ) {{ url('/') }}/title-post
                                                    </label>
                                                  </div>
                                                  
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <p>การตั้งค่า URL บทความ</p>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="radioarticle" id="radioarticle1" value="number" {{ option_get('article_type') == "number" ? "checked" : "" }}>
                                                    <label class="form-check-label mx-4" for="radioarticle1">
                                                        แบบตัวเลข {{ url('/') }}/article/123456
                                                    </label>
                                                  </div>
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="radioarticle" id="radioarticle2" value="title" {{ option_get('article_type') == "title" ? "checked" : "" }}>
                                                    <label class="form-check-label mx-4" for="radioarticle2">
                                                        แบบชื่อเรื่อง(แนะนำ) {{ url('/') }}/article/title-article
                                                    </label>
                                                  </div>
                                                  
                                            </div>
                                        </div>
                                        
                                            <div class="row">
                                            <div class="col-md-12 mt-4">
                                                <button class="btn btn-success btn-lg" id="save-data" type="submit">อัพเดท</button>
                                            </div>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                $("#save-data").click(function(event){
                                                event.preventDefault();
                                          
                                                let movie_type = $('input[name="radiomovie"]:checked').val();
                                                // let category_type = $('input[name="radiocategory"]:checked').val();
                                                let article_type = $('input[name="radioarticle"]:checked').val();
                                                let _token   = $('meta[name="csrf-token"]').attr('content');
                                                let user_token   = $('meta[name="remember-token"]').attr('content');

                                          
                                                $.ajax({
                                                  url: "{{ url('/') }}/api/v1/ajax",
                                                  type:"POST",
                                                  data:{
                                                    type: "{{ Request::get('type') }}",
                                                    movie_type:movie_type,
                                                    // category_type:category_type,
                                                    article_type:article_type,
                                                    _token: _token,
                                                    user_token:user_token
                                                  },
                                                  success:function(response){
                                                    Swal.fire(
                                                        'บันทึกสำเร็จ',
                                                        '',
                                                        'success'
                                                    )
                                                  },
                                                  error: function(error) {
                                                    Swal.fire(
                                                        'Error',
                                                        '',
                                                        'error'
                                                    )
                                                  }
                                                 });
                                            });
                    
                                                
                                            });
                                        </script>
                                @endif

                                @if(Request::get('type') == "banner_setting")
                                    <div class="form-group">
                                        <h2>{{ $header_title }}</h2>
                                        <div class="row mt-3">
                                            <div class="col-md-1 my-auto">
                                                <p>ตั้งค่าแบนเนอร์</p>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="banner_setting" class="form-control" id="banner_setting">
                                                    <option value="2" {{ option_get('banner_setting') == "2" ? "selected" : "" }}>2 ป้ายต่อ 1 แถว</option>
                                                    <option value="1" {{ option_get('banner_setting') == "1" ? "selected" : "" }}>1 ป้ายต่อ 1 แถว</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12 mt-4">
                                                <button class="btn btn-success btn-lg" id="save-data" type="submit">อัพเดท</button>
                                            </div>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                $("#save-data").click(function(event){
                                                event.preventDefault();
                                          
                                                let banner_setting = $('select[name="banner_setting"]').val();
                                                let _token   = $('meta[name="csrf-token"]').attr('content');
                                                let user_token   = $('meta[name="remember-token"]').attr('content');

                                          
                                                $.ajax({
                                                  url: "{{ url('/') }}/api/v1/ajax",
                                                  type:"POST",
                                                  data:{
                                                    type: "{{ Request::get('type') }}",
                                                    banner_setting:banner_setting,
                                                    _token: _token,
                                                    user_token: user_token,
                                                  },
                                                  success:function(response){
                                                    Swal.fire(
                                                        'บันทึกสำเร็จ',
                                                        '',
                                                        'success'
                                                    )
                                                  },
                                                  error: function(error) {
                                                    Swal.fire(
                                                        'Error',
                                                        '',
                                                        'error'
                                                    )
                                                  }
                                                 });
                                            });
                    
                                                
                                            });
                                        </script>
                                @endif

                                @if(Request::get('type') == "article_setting")
                                    <div class="form-group">
                                        <h2>{{ $header_title }}</h2>
                                        <div class="row mt-3">
                                            <div class="col-md-1 my-auto">
                                                <p>แสดงผลหน้าแรก</p>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="article_home" class="form-control" >
                                                    <option value="0" {{ option_get('article_home') == "0" ? "selected" : "" }}>ปิด</option>
                                                    <option value="1" {{ option_get('article_home') == "1" ? "selected" : "" }}>เปิด</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-1 my-auto">
                                                <p>แสดงบน Navbar</p>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="article_nav" class="form-control">
                                                    <option value="0" {{ option_get('article_nav') == "0" ? "selected" : "" }}>ปิด</option>
                                                    <option value="1" {{ option_get('article_nav') == "1" ? "selected" : "" }}>เปิด</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="row">
                                            <div class="col-md-12 mt-4">
                                                <button class="btn btn-success btn-lg" id="save-data" type="submit">อัพเดท</button>
                                            </div>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                $("#save-data").click(function(event){
                                                event.preventDefault();
                                          
                                                let article_home = $('select[name="article_home"]').val();
                                                let article_nav = $('select[name="article_nav"]').val();
                                                let _token   = $('meta[name="csrf-token"]').attr('content');
                                                let user_token   = $('meta[name="remember-token"]').attr('content');

                                          
                                                $.ajax({
                                                  url: "{{ url('/') }}/api/v1/ajax",
                                                  type:"POST",
                                                  data:{
                                                    type: "{{ Request::get('type') }}",
                                                    article_home:article_home,
                                                    article_nav:article_nav,
                                                    _token: _token,
                                                    user_token: user_token
                                                  },
                                                  success:function(response){
                                                    Swal.fire(
                                                        'บันทึกสำเร็จ',
                                                        '',
                                                        'success'
                                                    )
                                                  },
                                                  error: function(error) {
                                                    Swal.fire(
                                                        'Error',
                                                        '',
                                                        'error'
                                                    )
                                                  }
                                                 });
                                            });
                    
                                                
                                            });
                                        </script>
                                @endif
                        </div>
                    </div>
                    <style>
                        h3 {
                            font-size: 20px;
                        }
                        input[type='radio'] { 
                            transform: scale(2); 
                        }
                        .form-check {
                            margin-bottom: 2rem;
                        }
                    </style>
@endsection
