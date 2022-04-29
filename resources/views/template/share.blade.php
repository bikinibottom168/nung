<div class="row justify-content-end">
    <div class="col-lg-8 text-right">
        <p class="share-header">แชร์ให้เพื่อนดูด้วย</p>
        {!! 
            Share::page(url()->current(), 'Share title')
            ->facebook()
            ->twitter()
            ->Telegram()
            ->whatsapp();
        !!}

    </div>
</div>