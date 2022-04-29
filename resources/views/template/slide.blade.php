<div class="col-lg-20 col-20">
    <div class="owl-carousel">
        @foreach ($movie_hot as $key)
            <div class="list-slide">
                <a href="{{ route('movie', ['title' => $key->slug_title]) }}">
                    <div class="slide-title">{{ $key->title }}</div>
                    <div class="slide-button-play">
                        <i class="far fa-play-circle" style="color: #FFBB00"></i>
                    </div>
                    <img src="{{ asset($key->image) }}" alt="" class="slide-poster" style="min-height: 190px; max-height: 190px">
                </a>
            </div>
        @endforeach
        <script>
            $(document).ready(function(){
                $(".owl-carousel").owlCarousel({
                    loop:true,
                    autoplay: true,
                    autoplayTimeout: 2000,
                    margin:15,
                    responsive: {
                        360: {
                            items: 2
                        },
                        480: {
                            items: 2
                        },
                        768: {
                            items: 6
                        },
                        1280: {
                            items: 8
                        }
    
                    }
                });
            });
        </script>
    </div>
</div>