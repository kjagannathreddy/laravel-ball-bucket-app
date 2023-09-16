@extends("master")
@section("content")
@if($filledBuckets)
    <h2>RESULT</h2><br />    
    The buckets have been filled as follows:
    @foreach ($filledBuckets as $index => $bucket)
        <p>Bucket {{$bucket['name']}}": (Capacity: {{$bucket['capacity']}} cubic inches):</p>
        @foreach ($bucket['filled_balls'] as $key => $ball)
        <p>Color: {{$key}}, Size: {{$bucket[$key]}} cubic inches, count - {{$ball}}</p>
        @endforeach
        <p>Remaining volume(cubic inches) - {{$bucket['remaining']}}</p>
        <hr>
    @endforeach
@endif
<div>
   <h2>Bucket List</h2> 
</div>
<table class="table table-striped">
    <thead>
        <th> Id </th>
        <th> Name </th>
        <th> Volume </th>
    </thead>

    <tbody>

        @if(count($buckets) > 0)
            @foreach($buckets as $bucket)
                <tr>
                    <td> {{$bucket->id}} </td>
                    <td> {{$bucket->name}} </td>
                    <td> {{$bucket->volume}} </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

<div>
   <h2>Ball List</h2> 
</div>
<table class="table table-striped">
    <thead>
        <th> Id </th>
        <th> Name </th>
        <th> Volume </th>
    </thead>

    <tbody>

        @if(count($balls) > 0)
            @foreach($balls as $ball)
                <tr>
                    <td> {{$ball->id}} </td>
                    <td> {{$ball->name}} </td>
                    <td> {{$ball->volume}} </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>


<hr>
<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 m-auto">
        <form action="{{route('output.show_output')}}" method="POST">
        @csrf
        @foreach($balls as $ballscolor)
            <table class="table justify-content-center">
                <tbody>
                    <tr>
                        <td>
                            <input type="hidden" name="records[{{ $ballscolor->id }}][id]" value="{{ $ballscolor->id }}">
                            <input type="hidden" name="records[{{ $ballscolor->id }}][volume]" value="{{ $ballscolor->volume }}">
                            <input type="hidden" name="records[{{ $ballscolor->id }}][name]" value="{{ $ballscolor->name }}">
                            {{ $ballscolor->name }}
                        </td>
                        <td>
                            <input type="text" name="records[{{ $ballscolor->id }}][count]" value="{{ $ballscolor->count }}">
                        </td>
                    </tr>
                </tbody>
            </table>
        @endforeach
            <hr>

            <div class="col-xl-6 text-right">
                <button type="submit" class="btn btn-success">Place balls in bucket </button>
            </div>
        </form>
    </div>
</div>

<hr>

@endsection
