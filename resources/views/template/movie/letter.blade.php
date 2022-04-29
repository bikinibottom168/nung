
<div class="col-lg-20 border-radius-1 p-5" style="background-color: #f2f4f5">
    <table class="table talbe-borderless table-responsive-xl">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">RESULT</th>
                <th scope="col">YEAR</th>
                <th scope="col">QUALITY</th>
                <th scope="col">GENRES</th>
                <th scope="col">VOTES</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($letter_list as $key => $value)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td><a href="{{ route('movie', ['title' => $value->slug_title]) }}" class="text-dark"><img src="{{ asset($value->image) }}" alt="{{ $value->title }}" width="50px" style="margin-right: 1.45rem">{{ $value->title }}</a></td>
                    <td class="text-center" >{!! $value->year == "" ? '<small>Unknown</small>' : $value->year !!}</td>
                    <td class="text-center"><b class="detail-resolution border-radius-1">{{ $value->resolution }}</b></td>
                    <td class="text-center">{{ env('SCRIPT_TYPE', 'movie') == "av" ? "AV ซับไทย" : "--" }}</td>
                    <td class="text-center"><i class="fa fa-star text-warning" aria-hidden="true"></i>{{ $value->votes == "" ? "0" : $value->votes }}</td>
                </tr>
            @empty
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td class="text-center" ></td>
                    <td class="text-center"><b class="detail-resolution border-radius-1">--ไม่พบหนัง--</b></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
