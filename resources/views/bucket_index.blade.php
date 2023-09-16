@extends("master")

@section("title") Buckets @endsection
@section("content")

<div class="row mb-4">
    <div class="col-xl-6">
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">× </button>
                {{Session::get('success')}}
            </div>
        @endif
        @if(Session::has('failed'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">× </button>
                {{Session::get('failed')}}
            </div>
        @endif
    </div>

    <div class="col-xl-6 text-right">
        <a href="{{route('buckets.create')}}" class="btn btn-success "> Add New </a>
    </div>
</div>

<table class="table table-striped">
    <thead>
        <th> Name </th>
        <th> Volume </th>
        <th> Action </th>
    </thead>

    <tbody>

        @if(count($buckets) > 0)
            @foreach($buckets as $bucket)
                <tr>
                    <td> {{$bucket->name}} </td>
                    <td> {{$bucket->volume}} </td>
                    <td>
                        <form action="{{route('buckets.destroy', $bucket->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"> Delete </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

@endsection
