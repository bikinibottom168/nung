<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">
        
    <nav id="sidebar">
        <div class="shadow-bottom"></div>

        <ul class="list-unstyled menu-categories" id="accordionExample">
            
            {{-- <li class="menu">
                <li class="menu">
                    <a href="{{ route('admin.iammovie') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                            <span>API MOVIE</span>
                        </div>
                    </a>
                </li>
            </li> --}}

            <li class="menu">
                <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-youtube"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>
                        <span>Movies & Tv show</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="app" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('admin.movie') }}"> MOVIE </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.movie.series') }}"> TV SHOW </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.category') }}"> CATEGORY  </a>
                    </li>
                    @if(env('SCRIPT_TYPE', '') == "movie" || env('SCRIPT_TYPE', '') == "anime")
                    <li>
                        <a href="{{ route('admin.playlist') }}"> PLAYLIST  </a>
                    </li>
                    @endif
                </ul>
            </li>
            <li class="menu">
                <li class="menu">
                    <a href="{{ route('admin.article') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                            <span>Article</span>
                        </div>
                    </a>
                </li>
            </li>

            <li class="menu">
                <li class="menu">
                    <a href="{{ route('admin.banner') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                            <span>Banner</span>
                        </div>
                    </a>
                </li>
            </li>

            <li class="menu">
                <li class="menu">
                    <a href="{{ route('admin.about') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                            <span>Menu</span>
                        </div>
                    </a>
                </li>
            </li>

            <li class="menu">
                <a href="{{ route('admin.media') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
                        <span>Media Manager</span>
                    </div>
                </a>
            </li>

            <li class="menu">
                <li class="menu">
                    <a href="{{ route('admin.member') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            <span>Member</span>
                        </div>
                    </a>
                </li>
            </li>
            
            <li class="menu">
                <a href="#themes" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pen-tool"><path d="M12 19l7-7 3 3-7 7-3-3z"></path><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path><path d="M2 2l7.586 7.586"></path><circle cx="11" cy="11" r="2"></circle></svg>                        <span>Theme Setting</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="themes" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('admin.themesetting') }}?type=general_color"> general </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.themesetting') }}?type=css_custom"> CSS Custom </a>
                    </li>                     
                    {{-- <li>
                        <a href="{{ route('admin.themesetting') }}?type=redirect"> Redirect </a>
                    </li> --}}
                    {{-- <li>
                        <a href="{{ route('admin.themesetting') }}?type=social"> Social Network </a>
                    </li> --}}
                </ul>
            </li>
            
            <li class="menu">
                <a href="#seo" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>
                        <span>SEO</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="seo" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('admin.seo') }}?type=general"> General Settings </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.seo') }}?type=onpage"> Onpage </a>
                    </li>  
                    <li>
                        <a href="{{ route('admin.seo') }}?type=webmaster"> Webmaster Tool </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.seo') }}?type=sitemap"> Sitemaps </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.seo') }}?type=robots"> Robots.txt </a>
                    </li>                            
                    {{-- <li>
                        <a href="{{ route('admin.seo') }}?type=redirect"> Redirect </a>
                    </li> --}}
                    {{-- <li>
                        <a href="{{ route('admin.seo') }}?type=social"> Social Network </a>
                    </li> --}}
                </ul>
            </li>

            <li class="menu">
                <a href="#authentication" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <span>Security</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="authentication" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('admin.security') }}?type=recaptcha"> reCAPTCHA </a>
                    </li>
                </ul>
            </li>

            <li class="menu">
                <a href="#elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zap"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                        <span>Setting</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="elements" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('admin.setting')."?type=general" }}"> General </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.setting')."?type=read" }}"> Read </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.setting')."?type=banner_setting" }}"> Banner Setting </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.setting')."?type=article_setting" }}"> Article Setting </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.log') }}"> Logs </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
<!--  END SIDEBAR  -->