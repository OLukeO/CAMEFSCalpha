@extends('base')
<link rel='stylesheet' href='https://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css'>
@section('main')
<div class="row">
    <div class="col-sm-12">
        <h1 class="display-3" style="margin: 20px 0 20px 35%;">靜宜Beacon資料</h1>

        <div class="col-sm-12">
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

            @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            @if(session()->get('fail'))
            <div class="alert alert-warning">
                {{ session()->get('fail') }}
            </div>
            　　 @endif
        </div>

        <table class="table table-striped">
            <thead>
                <tr>

                    <td>
                        <h5>Beacon的Major</h5>
                    </td>
                    <td>
                        <h5>Beacon的Minor</h5>
                    </td>
                    <td>
                        <h5>Beacon所在緯度</h5>
                    </td>
                    <td>
                        <h5>Beacon所在經度</h5>
                    </td>
                    <td>
                        <h5>Beacon的UUID</h5>
                    </td>
                    <td colspan=2>
                        <h5>動作<a href="{{ url('beacons/create') }}" class="abc" style="margin:0 0 0 38%">新增</a></h5>
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach($beacons as $place)
                <tr>
                    <td>{{$place->major}}</td>
                    <td>{{$place->minor}}</td>
                    <td>{{$place->lat}}</td>
                    <td>{{$place->lng}}</td>
                    <td>{{$place->uuid}}</td>
                    <td>
                        <a href="{{ route('beacons.edit',$place->id)}}" class="btn btn-primary">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('beacons.destroy', $place->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')"
                                type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div>
        </div>
        @endsection
