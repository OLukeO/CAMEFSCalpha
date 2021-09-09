@extends('base')

@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">新增景點資料</h1>
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
            <form method="post" action="{{ route('places.store') }}" enctype="multipart/form-data">

                @csrf



                <div class="form-group">
                    <label for="name">景點名稱</label>
                    <input type="text" class="form-control" name="viewname" />
                </div>

                <div class="form-group">
                    <label for="input">景點介紹</label>
                    <textarea type="text" class="form-control" rows="3" name="note"></textarea>
                </div>

                <div class="form-group">
                    <label for="input">
                        <h3>景點對應的Major和Minor</h3>
                    </label>

                    <table class="table table-striped">
                        <tbody>

                            <select name="major" style="font-size:35px;">
                                @foreach($beacons as $place)
                                <option value={{$place->major}}{{$place->minor}}>
                                    Major : {{$place->major}} ,
                                    Minor : {{$place->minor}}
                                </option>
                                @endforeach
                            </select>

                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <label for="input">景點緯度</label>
                    <input type="text" class="form-control" name="lat" />
                </div>

                <div class="form-group">
                    <label for="input">景點經度</label>
                    <input type="text" class="form-control" name="lng" />
                </div>

                <div class="form-group">
                    <label for="input">景點相關超連結</label>
                    <input type="text" class="form-control" name="url" />
                </div>

                <div class="form-group">
                    <label for="input">景點照片連結</label>
                    <input type="text" class="form-control" name="image" />

                </div>

                <button type="submit" class="btn btn-primary-outline">確定新增</button>
            </form>

        </div>
    </div>
</div>
@endsection
