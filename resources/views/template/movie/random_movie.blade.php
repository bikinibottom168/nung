<div class="col-lg-20 col-20 mt-4">
    <p>หนังเรื่องอื่นๆ</p>
    <div class="owl-carousel" id="owl-carousel-movie">
        @foreach ($movie_hot as $key)
            <div class="list-slide">
                <a href="{{ route('movie', ['title' => $key->slug_title]) }}">
                    <div class="slide-title">{{ $key->title }}</div>
                    <div class="slide-button-play">
                        <i class="far fa-play-circle" style="color: #FFBB00"></i>
                    </div>
                    <img src="{{ asset($key->image) }}" alt="" class="slide-poster">
                </a>
            </div>
        @endforeach
        <style>
            .owl-carousel {
                overflow: hidden;
                position: relative;
                width: 100%;
            }
            .list-slide {
                cursor: pointer;
            }
            
            .list-slide:hover .slide-title{
                opacity: 0;
            }
            .list-slide:hover .slide-button-play{
                opacity: 1;
                transform: scale(1);
            }
            .list-slide:hover .slide-poster{
                opacity: 0.7;
            }
            .slide-poster {
                opacity: 1;
                transition: 0.5s;
            }
            .slide-button-play {
                transition: 0.3s;
                transform: scale(0);
                opacity: 0;
                position: absolute;
                left: 0;
                right: 0;
                bottom: 0;
                top: 0;
                margin: auto;
                width: 3rem;
                height: 3rem;
                /* line-height: 3rem; */
                border-radius: 50%;
                text-align: center;
                font-size: 2rem;
                z-index: 2;
            }
            .slide-title {
                transition: 0.5s;
                opacity: 1;
                position: absolute;
                left: 0;
                right: 0;
                bottom: 0;
                max-height: none;
                padding: 50px 10px 10px;
                border-radius: 0 0 10px 10px;
                font-size: .80rem;
                line-height: 1rem;
                pointer-events: none;
                white-space: normal;
                margin-bottom: 0;
                background: linear-gradient(to bottom,rgba(0,0,0,0) 0,rgba(0,0,0,.65) 100%);
                color: #fff;
                text-align: center;
            }
        </style>
        <script>
            $(document).ready(function(){
                $("#owl-carousel-movie").owlCarousel({
                    loop:true,
                    autoplay: true,
                    autoplayTimeout: 10000,
                    margin:15,
                    responsive: {
                        480: {
                            items: 4
                        },
                        768: {
                            items: 6
                        },
                        1280: {
                            items: 6
                        }
    
                    }
                });
            });
        </script>
    </div>
</div>