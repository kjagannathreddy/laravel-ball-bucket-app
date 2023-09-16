@extends("master")
@section("title") Show Bucket @endsection
@section("content")

<div class="container">
    <div class="row">
        <div class="col-xl-12 col-lg-12 text-right">
            <a href="{{route('buckets.index')}}" class="btn btn-danger"> Back to Buckets </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 m-auto">
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="card-title"> Show Bucket </h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name"> Name </label>
                        <input type="text" readonly name="name" class="form-control" id="name" value="@if(!empty($bucket)) {{$bucket->name}} @endif">
                    </div>

                    <div class="form-group">
                        <label for="volume"> Volume </label>
                        <input type="text" readonly name="volume" class="form-control" id="volume" value="@if(!empty($bucket)) {{$bucket->volume}} @endif">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection