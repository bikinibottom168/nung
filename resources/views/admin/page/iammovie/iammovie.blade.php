@extends('admin.master')

@section('body')
    <!-- column -->
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="mb-4">{{ $header_title }}</h3>
                <a href="{{ route('admin.movie') }}" class="btn btn-primary">ทั้งหมด</a>
                <a href="{{ route('admin.movie.create') }}" class="btn waves-effect waves-light btn-success pull-right hidden-sm-down btn-md">เพิ่มหนัง</a>
                <a href="{{ route('admin.category.create') }}" class="btn waves-effect waves-light btn-warning pull-right hidden-sm-down btn-md">เพิ่มหมวดหมู่</a>
            </div>
            <div class="">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col" class="sort" data-sort="name">#</th>
                            <th scope="col" class="sort" data-sort="budget">รูปภาพ</th>
                            <th scope="col" class="sort" data-sort="status">ชื่อเรื่อง</th>
                            <th scope="col">ตั้งค่า Playlist</th>
                            <th scope="col" class="sort" data-sort="completion">แก้ไข</th>
                            <th scope="col" class="sort" data-sort="completion">ลบ</th>
                          </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($movie as $k)
                                <tr>
                                        <td class="budget">{{ $k->id }}</td>
                                        <td class="budget"><img src="{{ asset($k->image) }}" width="70px"></td>
                                        @if(env("MOVIE_HOT",'0') == 1)
                                        <td class="budget"><b style="color: {{ $k->movie_hot == 1 ? 'green' : 'red' }}">{{ $k->movie_hot == 1 ? 'เปิด' : 'ปิด' }}</b></td>
                                        @endif
                                        <td class="budget">{{ $k->title }}</td>
                                        <td class="budget">
                                            <select class="form-control form-control-line playlist_select" name="playlist_select" id="playlist_select" data-id-movie="{{ $k->id }}" >
                                                <option value="-1" >ไม่มี Playlist</option>
                                                @if(isset($playlist))
                                                    @foreach ($playlist as $item_playlist)
                                                        @php
                                                            $selected = "";
                                                            $result_playlist = (array) json_decode($item_playlist->playlist);

                                                            for($i = 0; $i < count($result_playlist); $i++)
                                                            {
                                                                if($result_playlist[$i] == $k->id) {
                                                                    $selected = "selected";
                                                                }
                                                            }
                                                        @endphp
                                                        <option value="{{ $item_playlist->id }}" {{ $selected }}>{{ $item_playlist->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </td>
                                        <td class="budget">
                                            <a href="{{ route('admin.movie.edit', ['id'=> $k->id]) }}" class="btn btn-warning waves-effect waves-light pull-right hidden-sm-down btn-block" >แก้ไข</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.movie.destroy', ['id'=> $k->id]) }}" method="POST">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down btn-block"  onclick="return confirm('ยืนยันลบข้อมูล')">ลบ</button>
                                            </form>
                                        </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
            <div class="card-footer">
                {{ $movie->links('admin.page.paginate') }}
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            var token = "{{ Auth::user()->remember_token }}";
            $(".playlist_select").change(function(){
                var id_playlist = $(this).val();
                var id_movie = $(this).attr("data-id-movie");
                console.log('{{ url('/') }}/api/v1/update/playlist/'+id_playlist+'/'+id_movie+'/'+token);
                $.ajax({
                    url: '{{ url('/') }}/api/v1/update/playlist/'+id_playlist+'/'+id_movie+'/'+token,
                    type: 'get'
                })
                .done(function(data) {
                    alert("เพิ่ม Playlist สำเร็จ");
                });
            });
        });
    </script>
@endsection
