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
                <h3 class="mb-4">Logs</h3>
            </div>
            <div class="">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col" class="sort" data-sort="name">ประเภท</th>
                            <th scope="col" class="sort" data-sort="budget">ข้อความ</th>
                            <th scope="col" class="sort" data-sort="status">เวลา</th>
                            <th scope="col" class="sort" data-sort="completion">โดย</th>
                          </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($log as $k)
                                <tr>
                                    <td class="budget"><b class="text-{{ $k->type == "Delete" ? "danger" : ($k->type == "Update" ? "warning" : ($k->type == "Create" ? "success" : "primary")) }}">{{ $k->type }}</b></td>
                                    <td class="budget">{{ $k->message }}</td>
                                    <td class="budget">{{ $k->created_at }}</td>
                                    <td class="budget">{{ $k->user }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
            <div class="card-footer">
                {{ $log->links('admin.page.paginate') }}
            </div>
        </div>
    </div>
@endsection
