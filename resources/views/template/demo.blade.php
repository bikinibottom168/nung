@if(env('DEMO','0') == "1")

<div class="row">
    <div class="col-lg-20 bg-light fixed-bottom text-center mb-auto mt-auto p-3" style="z-index: 100 ">
        <a href="https://line.me/ti/p/~@iamtheme.th" class="text-dark fs-4" style="text-decoration: none" target="_blank">{{ $text }} <button class="btn btn-success">LINE: @iamtheme.th</button></a>
    </div>
</div>

@endif