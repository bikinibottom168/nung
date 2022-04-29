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

                                            @if(Request::get('type') == "recaptcha")
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-2 col-form-label">reCaptcha Status</label>
                                                    <div class="col-sm-8">
                                                      <select name="status" id="status" class="form-control">>
                                                        <option value="0" {{ option_get('recaptcha.status') == "0" ? "selected" : "" }}>
                                                            DISABLE
                                                        </option>
                                                        <option value="1" {{ option_get('recaptcha.status') == "1" ? "selected" : "" }}>
                                                            ENABLE
                                                        </option>
                                                      </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-2 col-form-label">reCaptcha Sitekey</label>
                                                    <div class="col-sm-8">
                                                      <input type="text"  name="sitekey" placeholder="sitekey XXXXXXXXXXXXXXXXXXXXXXXXXX" class="form-control form-control-line" value="{{ option_get("recaptcha.sitekey") }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-2 col-form-label">reCaptcha Secret</label>
                                                    <div class="col-sm-8">
                                                      <input type="text"  name="secret" placeholder="secret XXXXXXXXXXXXXXXXXXXXXXXXXX" class="form-control form-control-line" value="{{ option_get("recaptcha.secret") }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <a href="https://www.youtube.com/watch?v=Yie3N9nWiME" class="btn btn-warning btn-sm" target="_blank">วิธีติดตั้ง reCaptcha</a>
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
                                              
                                                    let sitekey = $("input[name=sitekey]").val();
                                                    let secret = $("input[name=secret]").val();
                                                    let status = $("#status").val();
                                                    let _token   = $('meta[name="csrf-token"]').attr('content');
                                                    let user_token   = $('meta[name="remember-token"]').attr('content');

                                              
                                                    $.ajax({
                                                      url: "{{ url('/') }}/api/v1/ajax",
                                                      type:"POST",
                                                      data:{
                                                        type: "{{ Request::get('type') }}",
                                                        sitekey:sitekey,
                                                        secret:secret,
                                                        status: status,
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

                                            @if(Request::get('type') == "loginfalied")
                                            <div class="col-md-12 col-sm-12">
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

                                        </div>
                                    </div>
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>
@endsection
