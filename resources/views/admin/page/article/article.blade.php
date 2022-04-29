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
            <div class="card-body">
                <a href="{{ route('admin.article.create') }}" class="btn waves-effect waves-light btn-success pull-right hidden-sm-down btn-md">สร้างบทความ</a>
                <h4 class="card-title">{{ $header_title }}</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ชื่อ</th>
                                <th>วิว</th>
                                <th>วันที่</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($request as $k)
                                <tr>
                                    <td>{{ $k->id }}</td>
                                    <td>
                                        <a href="{{ route('article', ['title' => $k->slug_title]) }}" target="_blank">{{ $k->title }}</a>
                                        <br>
                                        <br>
                                        <a href="{{ route('admin.article.edit', ['id'=> $k->id]) }}" class="text-warning" style="cursor: pointer">แก้ไข</a> |
                                        <b class="text-danger" style="cursor: pointer" onclick="event.preventDefault(); document.getElementById('article-{{ $k->id }}').submit();">ลบ</b>
                                        <form action="{{ route('admin.article.destroy', ['id'=> $k->id]) }}" id="article-{{ $k->id }}" method="POST">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                        </form>
                                    </td>
                                    <th>{{ number_format($k->view) }}</th>
                                    <th>
                                        {{ $k->created_at->format('d/m/Y') }}
                                        <br>
                                        <p class="badge badge-success">เผยแพร่</p>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
