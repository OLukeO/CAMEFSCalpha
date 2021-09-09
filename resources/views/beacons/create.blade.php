@extends('base')

@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">新增Beacon資料</h1>
        <div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
            @endif
            <form method="post" action="{{ route('beacons.store') }}" enctype="multipart/form-data">
                @csrf


                <div class="form-group">
                    <label for="major">Beacon的Major</label>
                    <input type="text" class="form-control" name="major" />
                </div>

                <div class="form-group">
                    <label for="minor">Beacon的Minor</label>
                    <input type="text" class="form-control" name="minor" />
                </div>

                <div class="form-group">
                    <label for="lat">Beacon所在緯度</label>
                    <input type="double" class="form-control" name="lat" />
                </div>

                <div class="form-group">
                    <label for="lng">Beacon所在經度</label>
                    <input type="double" class="form-control" name="lng" />
                </div>

                <div class="form-group">
                    <label for="uuid">Beacon的UUID</label>
                    <input type="text" class="form-control" name="uuid" />
                </div>


                <button type="submit" class="btn btn-primary-outline">確定新增</button>
            </form>
        </div>
    </div>
</div>
@endsection
