@extends('admin.master')


@section('body')
    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" enctype="multipart/form-data" action="{{ route('admin.playlist.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="split" value="0" style="display: none">
                                    <div class="form-group row">
                                        <div class="col-md-6 col-sm-6">
                                            <label>ชื่อ Playlist</label>
                                            <input type="text" name="title" placeholder="Ttitle Playlist" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    {{-- <div class="form-group row">
                                        <div class="col-md-6 col-sm-6">
                                            <label>ตั้งค่าภาพปก</label>
                                            <select class="form-control form-control-line" id="image_playlist" name="image_playlist">
                                                <option value="0">Auto</option>
                                                <option value="1">อัพภาพเอง</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="form-group row">
                                        <div class="col-md-12 col-12">
                                            <label for="image_poster">ภาพหน้าปก Playlist</label>
                                            <input type="file" class="form-control-file" name="image_poster" id="image_poster">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <button class="btn btn-success btn-lg" type="submit">เพิ่ม Playlist</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function() {
                            $("#image_playlist").change(function(){
                                let image_option = $(this).val();
                                if(image_option == 0)
                                {
                                    $("#image_poster").attr('disabled', 'disabled');
                                }
                                else if(image_option == 1)
                                {
                                    $("#image_poster").removeAttr('disabled');
                                }
                            });
                        });
                    </script>
@endsection
