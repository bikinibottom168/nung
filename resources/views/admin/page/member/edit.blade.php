@extends('admin.master')


@section('body')
    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" enctype="multipart/form-data" action="{{ route('admin.member.update', ['id' => $request->id]) }}" method="POST">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12">
                                            <label>ชื่อผู้ใช้</label>
                                            <input type="text" name="email" placeholder="" class="form-control form-control-line" value="{{ $request->email }}" readonly>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <label>รหัสผ่าน (กำหนดรหัสผ่านใหม่)</label>
                                            <input type="text" name="password" placeholder="" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <button class="btn btn-success btn-lg" type="submit">แก้ไข</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
@endsection
