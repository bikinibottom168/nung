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

                                            @if(Request::get('type') == "css_custom")
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-12 col-form-label">Custom CSS</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" id="css_custom" rows="20" class="form-control form-control-line">{{ option_get('css_custom') }}</textarea>
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
                                              
                                                    let css_custom = $("#css_custom").val();
                                                    let _token   = $('meta[name="csrf-token"]').attr('content');
                                                    let user_token   = $('meta[name="remember-token"]').attr('content');
                                              
                                                    $.ajax({
                                                      url: "{{ url('/') }}/api/v1/ajax",
                                                      type:"POST",
                                                      data:{
                                                        type: "{{ Request::get('type') }}",
                                                        css_custom: ""+css_custom+"",
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
                                            

                                            @if(Request::get('type') == "general_color")
                                            <div class="col-md-12 col-sm-12">
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <label>Primary Color </label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        {{-- <input id="secondary" class="color-picker form-control" name="color_secondary" value='{{ option_get('primary_color') }}' /> --}}
                                                        <div id="primary_color"></div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <label>Navbar Color </label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div id="navbar_color"></div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <label>Footer Color </label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div id="footer_color"></div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <label>Background Color</label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        {{-- <input id="primary" class="color-picker form-control" name="color_primary" value='{{ option_get('bg_color') }}' /> --}}
                                                        <div id="bg_color"></div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <label>Content Background Color</label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        {{-- <input id="primary" class="color-picker form-control" name="color_primary" value='{{ option_get('bg_color') }}' /> --}}
                                                        <div id="content_bg_color"></div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <label>Movie Label Color </label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div id="badge_color"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mt-4">
                                                        <button class="btn btn-success btn-lg" id="save-data">อัพเดท</button>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <script type="text/javascript">
                                                let primary_color = new Grapick({el: '#primary_color'});
                                                let navbar_color = new Grapick({el: '#navbar_color'});
                                                let bg_color = new Grapick({el: '#bg_color'});
                                                let badge_color = new Grapick({el: '#badge_color'});
                                                let footer_color = new Grapick({el: '#footer_color'});
                                                let content_bg_color = new Grapick({el: '#content_bg_color'});

                                                primary_color.setValue("{{ option_get('primary_color') }}");
                                                navbar_color.setValue("{{ option_get('navbar_color') }}");
                                                bg_color.setValue("{{ option_get('bg_color') }}");
                                                badge_color.setValue("{{ option_get('badge_color') }}");
                                                footer_color.setValue("{{ option_get('footer_color') }}");
                                                content_bg_color.setValue("{{ option_get('content_bg_color') }}");

                                                primary_color.setDirection("bottom");
                                                navbar_color.setDirection("left");
                                                footer_color.setDirection("left");
                                                bg_color.setDirection("bottom");
                                                content_bg_color.setDirection("bottom");
                                                badge_color.setDirection("bottom");

                                            </script>

                                            <script>
                                                $(document).ready(function() {
                                                    $("#save-data").click(function(event){
                                                    event.preventDefault();

                                                    let _token   = $('meta[name="csrf-token"]').attr('content');
                                                    let user_token   = $('meta[name="remember-token"]').attr('content');
                                              
                                                    $.ajax({
                                                      url: "{{ url('/') }}/api/v1/ajax",
                                                      type:"POST",
                                                      data:{
                                                        type: "{{ Request::get('type') }}",
                                                        primary_color:primary_color.getValue(),
                                                        navbar_color:navbar_color.getValue(),
                                                        bg_color:bg_color.getValue(),
                                                        badge_color:badge_color.getValue(),
                                                        footer_color:footer_color.getValue(),
                                                        content_bg_color:content_bg_color.getValue(),
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



                                        </div>
                                    </div>
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>
@endsection

