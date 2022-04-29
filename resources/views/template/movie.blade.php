<div class="row">
    @include('template.ads.ads-mt')
    <div class="col-lg-20 col-20">
        <div class="movie-card border-radius-1">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-14">
                    <div class="position-relative">
                        <img src="{{ $movie->image ? asset($movie->image) : '' }}" alt="{{ $movie->title }}"
                        class="img-fluid ">
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#trailer" style="position: absolute;right: 4px; top: 4px; border-radius: 20px">ตัวอย่าง</button>
                    </div>
                </div>
                <div class="col-lg-15 col-20 text-white">
                    <h1 class="movie-title text-warning">{{ trim($seo->front_seo) }} {{ $movie->title }}</h1>
                    <i class="fa fa-calendar text-white" aria-hidden="true"></i> @if($movie->year != "") <a class="badge badge-dark" href="{{ route('year',['id' => $movie->year]) }}">หนังปี {{ $movie->year }}</a> @else - @endif
                    <br>
                    <b style="color: white">IMDB</b> <b class="text-white badge badge-dark">{{ $movie->score }}</b>
                    <br>
                    <b class="text-white">Director:</b> {{ $movie->director != "" ? $movie->director : "-" }}
                    <br class="my-4">
                    <b class="text-white">Actors:</b> {{ $movie->actors != "" ? $movie->actors : "-" }}
                    <br>
                    <b class="text-white">Genres:</b> 
                    @if(isset($genre))
                        @foreach ( $genre as $val )
                            <a href="{{ route('category', ['title' => $val->title_category]) }}">{{ $val->title_category }}</a>
                            @if(!$loop->last)
                            ,
                            @endif
                        @endforeach
                    @else
                        -
                    @endif
                    <hr>
                    <p class="text-white badge badge-secondary">เรื่องย่อ</p>
                    <p class="text-white" id="description" style="display: -webkit-box;
                    -webkit-line-clamp: 4;
                    -webkit-box-orient: vertical;  
                    overflow: hidden;">{{ $movie->description }}</p>
                </div>
            </div>
        </div>
        <div id="trailer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 1000px">
                <div class="modal-content">
                    <div class="modal-body">
                        <iframe class="youtube-iframe"  src="https://www.youtube.com/embed/{{ $movie->youtube }}" width="100%" height="450px" frameborder="0" allowfullscreen=""></iframe>
                    </div>
                    <div class="modal-footer text-center">
                        <button class="btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
    <div class="col-lg-20 col-20 my-3">
        {{-- Ads On Top Movie --}}
        @include('template.movie.ads_on_movie_top')


        {{-- Player --}}
        @include('template.movie.player')
        {{-- Ads On Bottom Movie --}}
        @include('template.movie.ads_on_movie_bottom')

        
        @if($movie->type == "movie")
        <div class="card" style="background: {{ option_get('content_bg_color') }}">
            <div class="card-header">
                ตัวเล่นหลัก 
                @if(env('STREAMING_TYPE', 'proxy') == "streaming")
                    @if($movie->file_main != "" || $movie->file_openload != "" || $movie->file_streamango != "" || $movie->file_main_2 != "" || $movie->file_openload_2 != "" || $movie->file_streamango_2 != "" || $movie->file_main_3 != "" || $movie->file_openload_3 != "" || $movie->file_streamango_3 != "")
                        @php
                            $source = $movie->file_main != "" ? $movie->file_main : ($movie->file_main_2 != "" ? $movie->file_main_2 : ($movie->file_main_3 != "" ? $movie->file_main_3 : ''));
                            $source = route('streaming', base64_encode(Crypt::encryptString($source)));
                        @endphp
                        <button class="btn btn-danger sound_path" type="button" data-sound="sound_th" class="sound_path btn btn-primary" data-href="{{ $source }}">
                            <i class="fas fa-play"></i>
                            พากย์ไทย
                        </button>
                    @endif
                    @if($movie->file_main_sub != "" || $movie->file_openload_sub != "" || $movie->file_streamango_sub != "" || $movie->file_main_sub_2 != "" || $movie->file_openload_sub_2 != "" || $movie->file_streamango_sub_2 != "" || $movie->file_main_sub_3 != "" || $movie->file_openload_sub_3 != "" || $movie->file_streamango_sub_3 != "")
                        @php
                            $source = $movie->file_main_sub != "" ? $movie->file_main_sub : ($movie->file_main_sub_2 != "" ? $movie->file_main_sub_2 : ($movie->file_main_sub_3 != "" ? $movie->file_main_sub_3 : ''));
                            $source = route('streaming', base64_encode(Crypt::encryptString($source)));
                        @endphp
                        <button class="btn btn-dark sound_path" type="button" data-sound="sound_sub" class="sound_path btn btn-primary" data-href="{{ $source }}">
                            <i class="far fa-closed-captioning"></i>
                            ซับไทย
                        </button>
                    @endif
                @else
                    @if($movie->file_main != "" || $movie->file_openload != "" || $movie->file_streamango != "" || $movie->file_main_2 != "" || $movie->file_openload_2 != "" || $movie->file_streamango_2 != "" || $movie->file_main_3 != "" || $movie->file_openload_3 != "" || $movie->file_streamango_3 != "")
                        <button class="btn btn-link sound_path" type="button" data-sound="sound_th" class="sound_path btn btn-primary" data-href="{{ $movie->file_main != "" ? $movie->file_main : ($movie->file_main_2 != "" ? $movie->file_main_2 : ($movie->file_main_3 != "" ? $movie->file_main_3 : '' )) }}">
                            พากย์ไทย
                        </button>
                    @endif
                    @if($movie->file_main_sub != "" || $movie->file_openload_sub != "" || $movie->file_streamango_sub != "" || $movie->file_main_sub_2 != "" || $movie->file_openload_sub_2 != "" || $movie->file_streamango_sub_2 != "" || $movie->file_main_sub_3 != "" || $movie->file_openload_sub_3 != "" || $movie->file_streamango_sub_3 != "")
                        <button class="btn btn-link sound_path" type="button" data-sound="sound_sub" class="sound_path btn btn-primary" data-href="{{ $movie->file_main != "" ? $movie->file_main : ($movie->file_main_2 != "" ? $movie->file_main_2 : ($movie->file_main_3 != "" ? $movie->file_main_3 : '' )) }}">
                            <i class="far fa-closed-captioning"></i>
                            ซับไทย
                        </button>
                @endif
            @endif
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush sound-movie" id="sound_th">
                    @if($movie->file_main_sub_3 != "")
                        @php
                        // ตรวจสอบว่าเป็นไฟล์ MP4 ตรงหรือไม่
                        if(strrpos($movie->file_main_sub_3, '.mp4') !== false)
                        {
                            $movie->file_main_sub_3 = route('streaming', base64_encode(Crypt::encryptString($movie->file_main_sub_3)));
                        }
                        @endphp
                        <li class="list-group-item resolution" data-href="{{ $movie->file_main_sub_3 }}">360p</li>
                    @endif
                    @if($movie->file_main_sub_2 != "")
                        @php
                        // ตรวจสอบว่าเป็นไฟล์ MP4 ตรงหรือไม่
                        if(strrpos($movie->file_main_sub_2, '.mp4') !== false)
                        {
                            $movie->file_main_sub_2 = route('streaming', base64_encode(Crypt::encryptString($movie->file_main_sub_2)));
                        }
                        @endphp
                        <li class="list-group-item resolution" data-href="{{ $movie->file_main_sub_3 }}">720p</li>
                    @endif
                    @if($movie->file_main_sub != "")
                        @php
                        // ตรวจสอบว่าเป็นไฟล์ MP4 ตรงหรือไม่
                        if(strrpos($movie->file_main_sub, '.mp4') !== false)
                        {
                            $movie->file_main_sub = route('streaming', base64_encode(Crypt::encryptString($movie->file_main_sub)));
                        }
                        @endphp
                        {{-- <button data-href="{{ $movie->file_main_sub }}" type="button" class="resolution btn btn-primary"
                            style="color: #fff;margin-left: 0px;border-radius: 2px;border-bottom: 4px solid #127ba3;font-size: 13px;font-weight: 600;color: #fff;margin-right: 0px">
                            <i class="glyphicon glyphicon-hd-video"></i>
                            1080p
                        </button> --}}
                        <li class="list-group-item resolution" data-href="{{ $movie->file_main_sub }}">1080p</li>
                    @endif
                </ul>
                <ul class="list-group list-group-flush sound-movie" id="sound_sub" style="display: none">
                    @if($movie->file_main_sub_3 != "")
                        @php
                        // ตรวจสอบว่าเป็นไฟล์ MP4 ตรงหรือไม่
                        if(strrpos($movie->file_main_sub_3, '.mp4') !== false)
                        {
                            $movie->file_main_sub_3 = route('streaming', base64_encode(Crypt::encryptString($movie->file_main_sub_3)));
                        }
                        @endphp
                        <li class="list-group-item resolution" data-href="{{ $movie->file_main_sub_3 }}">360p</li>
                    @endif
                    @if($movie->file_main_sub_2 != "")
                        @php
                        // ตรวจสอบว่าเป็นไฟล์ MP4 ตรงหรือไม่
                        if(strrpos($movie->file_main_sub_2, '.mp4') !== false)
                        {
                            $movie->file_main_sub_2 = route('streaming', base64_encode(Crypt::encryptString($movie->file_main_sub_2)));
                        }
                        @endphp
                        <li class="list-group-item resolution" data-href="{{ $movie->file_main_sub_3 }}">720p</li>
                    @endif
                    @if($movie->file_main_sub != "")
                        @php
                        // ตรวจสอบว่าเป็นไฟล์ MP4 ตรงหรือไม่
                        if(strrpos($movie->file_main_sub, '.mp4') !== false)
                        {
                            $movie->file_main_sub = route('streaming', base64_encode(Crypt::encryptString($movie->file_main_sub)));
                        }
                        @endphp
                        {{-- <button data-href="{{ $movie->file_main_sub }}" type="button" class="resolution btn btn-primary"
                            style="color: #fff;margin-left: 0px;border-radius: 2px;border-bottom: 4px solid #127ba3;font-size: 13px;font-weight: 600;color: #fff;margin-right: 0px">
                            <i class="glyphicon glyphicon-hd-video"></i>
                            1080p
                        </button> --}}
                        <li class="list-group-item resolution" data-href="{{ $movie->file_main_sub }}">1080p</li>
                    @endif
                </ul>
            </div>
        </div>
        @endif
        @include('template.share')
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous"
            src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v11.0&appId=191119298119968&autoLogAppEvents=1"
            nonce="L89Z3QQR"></script>
        <div class="fb-comments" data-href="{{ Request::url() }}" data-width="100%" data-numposts="5"></div>

        @include('template.movie.random_movie')
    </div>
</div>
<script src="{{ asset('js/readmore.min.js') }}"></script>
<script type="text/javascript" src="http://www.youtube.com/player_api"></script>
<script>
    $(document).ready(function () {
        $('#trailer').on('hidden.bs.modal', function () {
            $('.youtube-iframe').each(function(index) {
            $(this).attr('src', $(this).attr('src'));
            return false;
      });
        });

        $("#share-movie").jsSocials({
            showLabel: false,
            showCount: false,
            shares: ["facebook", "twitter"]
        });

        $('#description').readmore({
            speed: 100,
            collapsedHeight: 20,
            heightMargin: 16,
            moreLink: '<a href="#" class="badge badge-light" >แสดงเพิ่ม</a>',
            lessLink: '<a href="#" class="badge badge-light">แสดงน้อย</a>',
            embedCSS: true,
            blockCSS: 'display: block; width: 100%;',
            startOpen: false,

            // callbacks
            blockProcessed: function () {},
            beforeToggle: function () {},
            afterToggle: function () {}
        });
    });
</script>

<style>
    .movie-card {
        background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.7)) 0% 0% / cover, url({{ asset($movie->image) }}) no-repeat center center;
        background-size: cover;
        padding: 20px;
    }
</style>