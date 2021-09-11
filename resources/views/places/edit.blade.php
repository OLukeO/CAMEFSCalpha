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

                            <option value="{{$placemajor}}{{$placeminor}}" selected>

                                Major : {{$placemajor}} ,

                                Minor : {{$placeminor}}

                            </option>

                            @foreach($beacons as $beacon)

                            <option value="{{$beacon->major}}{{$beacon->minor}}">

                                Major : {{$beacon->major}} ,

                                Minor : {{$beacon->minor}}

                            </option>

                            @endforeach

                        </select>

                    </tbody>
                </table>
            </div>

            <!--封鎖線 -->
            <div class="main_view">
                <div id="mapid">
                </div>
            </div>

            <script>
                //綁地圖
                var lat = "{!!$place->lat!!}";

                var lng = "{!!$place->lng!!}";
                var mymap = L.map('mapid').setView([24.227565, 120.581095], 17);
                //金鑰
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 18,
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    id: 'mapbox/streets-v11',
                }).addTo(mymap);

                var marker = L.marker([lat, lng]).addTo(mymap);

                var popup = L.popup();

                var LeafIcon = L.Icon.extend({
                    options: {
                        iconSize: [20, 20],
                    }
                });


                function onMapClick(e) {
                    popup
                        .setLatLng(e.latlng)
                        .setContent(e.latlng.toString())
                        .openOn(mymap);

                    var latlng = e.latlng.toString();

                    WriteValue(latlng);


                    function WriteValue() {
                        const all = latlng.split('(');

                        const all2 = all[1];

                        const all3 = all2.split(',');

                        const major = all3[0];

                        //chars3[0]

                        const major1 = all3[1];

                        const major2 = major1.split(' ');

                        const major3 = major2[1].split(')');

                        const minor = major3[0];

                        //chars6[0];

                        document.getElementById("lat").value = major;

                        document.getElementById("lng").value = minor;

                    }
                }

                mymap.on('click', onMapClick);

            </script>
            <!--封鎖線 -->

            <div class="form-group">
                <label for="lat">景點緯度</label>
                <input id="lat" type="text" class="form-control" name="lat" value={{ $place->lat }} />
            </div>

            <div class="form-group">
                <label for="lng">景點經度</label>
                <input id="lng" type="text" class="form-control" name="lng" value={{ $place->lng }} />
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
