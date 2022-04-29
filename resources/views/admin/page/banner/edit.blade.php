@extends('admin.master')


@section('body')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <div class="col-lg-12">
        <form class="form-horizontal form-material" enctype="multipart/form-data" action="{{ route('admin.banner.update', ['id'=> $request->id]) }}" method="POST">
                        <div class="card">
                            <div class="card-body">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-5 col-sm-12">
                                                <label>Title</label>
                                                <input type="text" name="title" placeholder="Title" class="form-control form-control-line" value="{{ $request->title_ads }}">
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label>สถานะใช้งาน</label>
                                                <select class="form-control form-control-line" name="status">
                                                    <option value="1" {{ $request->status_ads == 1 ? 'selected' : '' }}>เปิดใช้งาน</option>
                                                    <option value="0" {{ $request->status_ads == 0 ? 'selected' : '' }}>ปิด</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-sm-12">
                                                <label>แสดงผล</label>
                                                <select class="form-control form-control-line" name="show_ads">
                                                    <option value="0" {{ $request->show_ads == 0 ? 'selected' : '' }}>แสดงทุกหน้า</option>
                                                    <option value="1" {{ $request->show_ads == 1 ? 'selected' : '' }}>เฉพาะหน้าแรก</option>
                                                    <option value="2" {{ $request->show_ads == 2 ? 'selected' : '' }}>เฉพาะหน้าดูหนัง</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-sm-12">
                                                <label>หมดอายุ</label>
                                                <input type="text" name="expired" class="form-control form-control-line" id="end" value="{{ $request->expired }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-12">
                                                <label >ประเภท</label>
                                                <select class="form-control form-control-line" name="type">
                                                    <option value="0" {{ $request['type'] == 0 ? "selected" : '' }} >image</option>
                                                    <option value="1" {{ $request['type'] == 1 ? "selected" : ''}}>code</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label>ลิ้งเว็บ / script</label>
                                                <input type="text" name="url" placeholder="url" class="form-control form-control-line" value="{{ $request->url_ads }}">
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label>ตำแหน่ง</label>
                                                @if($request->layout_ads == "video")
                                                    <select class="form-control form-control-line" name="layout">
                                                        <option value="video" {{ $request->layout_ads == 'video' ? 'selected' : '' }}>วีดีโอ ADS</option>
                                                    </select>
                                                @else
                                                    <select class="form-control form-control-line" name="layout">
                                                        <option value="a" {{ $request->layout_ads == 'a' ? 'selected' : '' }}>A ทุกหน้า - ตรงกลางด้านบน (แนะนำ 920x200)</option>

                                                        <option value="f1" {{ $request->layout_ads == 'f1' ? 'selected' : '' }}>F1 ทุกหน้า - ซ้ายบนแนวตั้ง (แนะนำ 200x660)</option>
                                                        <option value="r1" {{ $request->layout_ads == 'r1' ? 'selected' : '' }}>R1 ทุกหน้า - ขวาบนแนวตั้ง (แนะนำ 200x660)</option>
                                                        <option value="r2" {{ $request->layout_ads == 'r2' ? 'selected' : '' }}>R2 ทุกหน้า - ป้ายขวาแสดงตรงเมนู (แนะนำ 250x250)</option>
                                                        <option value="aaa" {{ $request->layout_ads == 'aaa' ? 'selected' : '' }}>AAA ทุกหน้า - ป้ายลอยซ้าย (แนะนำ 180x160)</option>
                                                        <option value="bbb" {{ $request->layout_ads == 'bbb' ? 'selected' : '' }}>BBB ทุกหน้า - ป้ายลอยตรงกลางล่าง (แนะนำ 728x90)</option>
                                                        <option value="ccc" {{ $request->layout_ads == 'ccc' ? 'selected' : '' }}>CCC ทุกหน้า - ป้ายลอยขวา (แนะนำ 180x160)</option>
                                                        <option value="footer" {{ $request->layout_ads == 'footer' ? 'selected' : '' }}>FOOTER_MENU ด้านบนปุ่มเปลี่ยนหน้า (แนะนำ 728x90)</option>
                                                        <option value="mt" {{ $request->layout_ads == 'mt' ? 'selected' : '' }}>MT ด้านบนสุด แสดงเฉพาะหน้าดูหนัง (แนะนำ 728x90)</option>
                                                        <option value="m1" {{ $request->layout_ads == 'm1' ? 'selected' : '' }}>M1 เฉพาะหน้าดูหนัง - ด้านบนตัวเล่นหนัง (แนะนำ 728x90)</option>
                                                        <option value="m2" {{ $request->layout_ads == 'm2' ? 'selected' : '' }}>M2 เฉพาะหน้าดูหนัง - ด้านล่างตัวเล่นหนัง (แนะนำ 728x90)</option>
                                                        <option value="video" {{ $request->layout_ads == 'video' ? 'selected' : '' }}>VIDEO - ตัวเล่นหนัง</option>
                                                        <option value="overlay" {{ $request->layout_ads == 'overlay' ? 'selected' : '' }}>Overlay ป้ายแสดงใน Player</option>
                                                        <option value="code" {{ $request->layout_ads == 'code' ? 'selected' : '' }}>Code</option>
                                                    </select>
                                                @endif
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label>ลำดับโฆษณา (A คือล่างสุด)</label>
                                                <select class="form-control form-control-line" name="position">
                                                    @foreach (range('A','Z') as $val)
                                                    <option value="{{$val}}" {{ $request->position == $val ? "selected" : "" }}>{{$val}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="uploadImage">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if($request->layout_ads == "video")
                                                    <video width="300px" controls>
                                                        <source src="{{ $request->image_ads }}" type="video/mp4">
                                                    </video><br>
                                                    <label for="exampleFormControlFile1">VIDEO UPLOAD ขนาดไม่เกิน 10MB</label>
                                                @else
                                                    <img src="{{ asset($request->image_ads) }}" height=" 50px"><br>
                                                    <label for="exampleFormControlFile1">รูปภาพ</label>
                                                @endif
                                                <input type="file" class="form-control-file" name="file" id="exampleFormControlFile1">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-success btn-lg" type="submit">แก้ไข</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
      <script  type="text/javascript">
          $( "#end" ).datepicker({ dateFormat: 'yy-mm-dd' });
            $(document).ready(function() {
                $('select[name="type"]').each(function() {
                    if(this.value == "1") {
                     $('#uploadImage').hide();
                    }
                    else {
                        $('#uploadImage').show();
                    }
                });
                $('select[name="type"]').change(function() {
                    if(this.value == "1") {
                     $('#uploadImage').hide();
                    }
                    else {
                        $('#uploadImage').show();
                    }
                });
            });
      </script>
@endsection
