@extends('base')
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">更新資料</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br />
        @endif
        <form method="post" action="{{ route('beacons.update', $beacons->id) }}">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="name">Beacon的Major</label>
                <input type="text" class="form-control" name="major" value={{ $beacons->major }} />
            </div>

            <div class="form-group">
                <label for="input">Beacon的Minor</label>
                <input type="text" class="form-control" name="minor" value={{ $beacons->minor }} />
            </div>

            <div class="form-group">
                <label for="input">Beacon所在緯度</label>
                <input type="integer" class="form-control" name="lat" value={{ $beacons->lat }} />
            </div>

            <div class="form-group">
                <label for="input">Beacon所在經度</label>
                <input type="text" class="form-control" name="lng" value={{ $beacons->lng }} />
            </div>

            <div class="form-group">
                <label for="input">Beacon的UUID</label>
                <input type="text" class="form-control" name="uuid" value={{ $beacons->uuid }} />
            </div>



            <button type="submit" class="btn btn-primary">更新資料</button>
        </form>
    </div>
</div>
@endsection
