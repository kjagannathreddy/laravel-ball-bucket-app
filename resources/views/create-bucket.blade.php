@extends("master")
@section("title") Create Bucket @endsection
@section("content")

<div class="container">
    <div class="row">
        <div class="col-xl-12 col-lg-12 text-right">
            <a href="{{route('buckets.index')}}" class="btn btn-danger"> Back to Buckets </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 m-auto">
                <form action="{{route('buckets.store')}}" method="POST">
                @csrf
                <div class="card shadow">
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">× </button>
                            {{Session::get('success')}}
                        </div>
                    @elseif(Session::has('failed'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">× </button>
                            {{Session::get('failed')}}
                        </div>
                    @endif

                    <div class="card-header">
                        <h4 class="card-title"> Create Bucket </h4>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name"> Bucket Name </label>
                            <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}">
                            {!!$errors->first("name", "<span class='text-danger'>:message </span>")!!}
                        </div>

                        <div class="form-group">
                            <label for="volume"> Volume (in Inches) </label>
                            <input type="text" name="volume" class="form-control" id="volume" value="{{old('volume')}}">
                            {!!$errors->first("volume", "<span class='text-danger'>:message </span>")!!}
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success"> Save </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection