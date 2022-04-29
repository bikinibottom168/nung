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
                                {{-- <form class="form-horizontal form-material" enctype="multipart/form-data" action="{{ route('admin.seo.update', ['id'=> $request->id]) }}" method="POST">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }} --}}
                                    <div class="form-group">
                                        <h3>{{ $header_title }}</h3>
                                        <div class="row">
                                            @if(Request::get('type') == "general")
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>SEO title สำหรับหน้าแสดงหนัง</label>
                                                            <label for=""></label>
                                                            <p>
                                                                <code>
                                                                    ตัวอย่างโค๊ดฟังก์ชั่น <kbd>{movie_title} ชื่อเรื่อง</kbd> <kbd>{movie_description} เรื่องย่อของหนัง</kbd> <kbd>{title_web} Site Title</kbd>
                                                                </code>
                                                                <br>
                                                                <code>
                                                                    defalut: {movie_title} - {title_web}
                                                                </code>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <br>
                                                            <input type="text" name="seo_title" placeholder="{movie_title} - {title_web}" class="form-control form-control-line" value="{{ $seo->seo_title }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 mt-4">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>SEO Description สำหรับหน้าแสดงหนัง</label>
                                                            <label for=""></label>
                                                            <p>
                                                                <code>
                                                                    ตัวอย่างโค๊ดฟังก์ชั่น <kbd>{movie_title} ชื่อเรื่อง</kbd> <kbd>{movie_description} เรื่องย่อของหนัง</kbd> <kbd>{title_web} Site Title</kbd>
                                                                </code>
                                                                <br>
                                                                <code>
                                                                    defalut: {movie_description}
                                                                </code>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <input type="text" name="seo_description" placeholder="{movie_title} - {title_web}" class="form-control form-control-line" value="{{ $seo->seo_description }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12 mt-4">
                                                            <label>Title (หน้าดูหนัง)</label>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <input type="text" name="front_seo" class="form-control form-control-line" value="{{ $seo->front_seo }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12 mt-4">
                                                            <button class="btn btn-success btn-lg" id="save-data" type="submit">อัพเดท</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                    $(document).ready(function() {
                                                        $("#save-data").click(function(event){
                                                        event.preventDefault();
                                                  
                                                        let seo_title = $("input[name=seo_title]").val();
                                                        let seo_description = $("input[name=seo_description]").val();
                                                        let front_seo = $("input[name=front_seo]").val();
                                                        let _token   = $('meta[name="csrf-token"]').attr('content');
                                                        let user_token   = $('meta[name="remember-token"]').attr('content');
                                                  
                                                        $.ajax({
                                                          url: "{{ url('/') }}/api/v1/ajax",
                                                          type:"POST",
                                                          data:{
                                                            type: "{{ Request::get('type') }}",
                                                            seo_title:seo_title,
                                                            seo_description:seo_description,
                                                            front_seo:front_seo,
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
                                            {{-- END GENERAL --}}

                                            @if(Request::get('type') == "webmaster")
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-2 col-form-label">Google Search Console</label>
                                                    <div class="col-sm-8">
                                                      <input type="text"  name="google_search" placeholder="G-PTRXXXXXX" class="form-control form-control-line" value="{{ option_get("google_search") }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-2 col-form-label">Google Analytics</label>
                                                    <div class="col-sm-8">
                                                      <input type="text"  name="google_analytics" placeholder="XXXXXXXXXXXXXXXXXXXXXXXXXX" class="form-control form-control-line" value="{{ option_get("google_analytics") }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mt-4">
                                                        <button class="btn btn-success btn-lg" id="save-data">อัพเดท</button>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <script>
                                                $(document).ready(function() {
                                                    $("#save-data").click(function(event){
                                                    event.preventDefault();
                                              
                                                    let google_search = $("input[name=google_search]").val();
                                                    let google_analytics = $("input[name=google_analytics]").val();
                                                    let _token   = $('meta[name="csrf-token"]').attr('content');
                                                    let user_token   = $('meta[name="remember-token"]').attr('content');
                                              
                                                    $.ajax({
                                                      url: "{{ url('/') }}/api/v1/ajax",
                                                      type:"POST",
                                                      data:{
                                                        type: "{{ Request::get('type') }}",
                                                        google_search:google_search,
                                                        google_analytics:google_analytics,
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
                                            {{-- END WEBMASTER --}}

                                            @if(Request::get('type') == "onpage")
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-12 col-form-label">Onpage Header ใส่ข้อความด้านบนหน้าแรก</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" id="onpage_header" rows="20" class="form-control form-control-line">{{ option_get('onpage_header') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mt-4">
                                                        <button class="btn btn-success btn-lg" id="save-data">อัพเดท</button>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <script>
                                                $(document).ready(function() {
                                                    $("#save-data").click(function(event){
                                                    event.preventDefault();
                                              
                                                    let onpage_header = $("#onpage_header").val();
                                                    let _token   = $('meta[name="csrf-token"]').attr('content');
                                                    let user_token   = $('meta[name="remember-token"]').attr('content');
                                              
                                                    $.ajax({
                                                      url: "{{ url('/') }}/api/v1/ajax",
                                                      type:"POST",
                                                      data:{
                                                        type: "{{ Request::get('type') }}",
                                                        onpage_header:onpage_header,
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
                                            {{-- END ONPAGE --}}

                                            @if(Request::get('type') == "sitemap")
                                            <div class="col-md-12 col-sm-12">
                                                <br>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Sitemap</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input type="text" name="sitemap" placeholder="Sitemap" class="form-control form-control-line" value="{{ route('sitemap.index') }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mt-4">
                                                        {{-- <button class="btn btn-success btn-lg" id="save-data">อัพเดท</button> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            {{-- END SITEMAP --}}

                                            @if(Request::get('type') == "robots")
                                            <div class="col-md-12 col-sm-12">
                                                <br>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Robots.txt</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input type="text" name="sitemap" placeholder="Sitemap" class="form-control form-control-line" value="{{ url('/robots.txt') }}" readonly>
                                                    </div>
                                                    <div class="col-md-12 mt-4">
                                                        {{-- <button class="btn btn-success btn-lg" type="submit" onclick="return confirm('ยืนยันอัพเดทข้อมูล')">อัพเดท</button> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            {{-- ENDROBOTS --}}

                                        </div>
                                    </div>
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>
@endsection
