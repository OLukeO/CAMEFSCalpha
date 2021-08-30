<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">新增地點資料</h1>
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
            <form method="post" action="{{ route('attractions.store') }}" enctype="multipart/form-data">
                @csrf



                <div class="form-group">
                    <label for="name">BeaconID(iBeacon對應ID)</label>
                    <input type="Integer" class="form-control" name="beaconid" />
                </div>

                <div class="form-group">
                    <label for="input">景點經度</label>
                    <input type="double" class="form-control" name="lat" />
                </div>

                <div class="form-group">
                    <label for="input">景點緯度</label>
                    <input type="double" class="form-control" name="lng" />
                </div>

                <div class="form-group">
                    <label for="input">景點名稱</label>
                    <input type="text" class="form-control" name="viewname" />
                </div>

                <div class="form-group">
                    <label for="input">景點介紹</label>
                    <input type="text" class="form-control" name="note" />
                </div>

                <div class="form-group">
                    <label for="input">景點照片</label>
                    <input type="text" class="form-control" name="image" />
                </div>

                <div class="form-group">
                    <label for="input">景點相關超連結</label>
                    <input type="text" class="form-control" name="url" />
                </div>

                <div class="form-group">
                    <label for="input">景點人數</label>
                    <input type="Integer" class="form-control" name="peoplenumber" />
                </div>


                <button type="submit" class="btn btn-primary-outline">確定新增</button>
            </form>
        </div>
    </div>
</div>
@endsection
