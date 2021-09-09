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
        <form method="post" action="{{ route('places.update', $place->id) }}">

            @method('PATCH')
            @csrf

            <div class="form-group">
                <label for="viewname">景點名稱</label>
                <input type="text" class="form-control" name="viewname" value={{ $place->viewname }} />
            </div>

            <div class="form-group">
                <label for="note">景點介紹</label>
                <textarea type="text" class="form-control" rows="3" name="note">{{ $place->note }}</textarea>
            </div>

            <div class="form-group">
                <label for="input">
                    <h3>景點對應的Major和Minor</h3>
                </label>

                <table class="table table-striped">
                    <tbody>

                        <select name="major" style="font-size:35px;">
                            @foreach($beacons as $beacon)
                            <option value={{$beacon->major}}{{$beacon->minor}}>
                                Major : {{$beacon->major}} ,
                                Minor : {{$beacon->minor}}
                            </option>
                            @endforeach
                        </select>


                    </tbody>
                </table>
            </div>

            <div class="form-group">
                <label for="lat">景點緯度</label>
                <input type="text" class="form-control" name="lat" value={{ $place->lat }} />
            </div>

            <div class="form-group">
                <label for="lng">景點經度</label>
                <input type="text" class="form-control" name="lng" value={{ $place->lng }} />
            </div>

            <div class="form-group">
                <label for="url">景點相關超連結</label>
                <input type="text" class="form-control" name="url" value={{ $place->url }} />
            </div>


            <div class="form-group">
                <label for="image">景點照片連結</label>
                <input type="text" class="form-control" name="image" value={{ $place->image }} />
            </div>
            <button type="submit" class="btn btn-primary">更新資料</button>

        </form>
    </div>
</div>
@endsection
