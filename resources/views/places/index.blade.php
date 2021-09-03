@extends('base')
<link rel='stylesheet' href='https://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css'>
@section('main')
<div class="row">
    <div class="col-sm-12">
        <h1 class="display-3" style="margin: 20px 0 20px 35%;">靜宜景點</h1>

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
                        <h5 style="width:100px">景點名稱</h5>
                    </td>
                    <td>
                        <h5>景點介紹</h5>
                    </td>
                    <td>
                        <h5>景點對應的BeaconId</h5>
                    </td>
                    <td>
                        <h5>景點緯度</h5>
                    </td>
                    <td>
                        <h5>景點經度</h5>
                    </td>
                    <td>
                        <h5>景點相關超連結</h5>
                    </td>
                    <td>
                        <h5>景點人數</h5>
                    </td>
                    <td>
                        <h5>景點照片連結</h5>
                    </td>
                    <td colspan=2>
                        <h5>動作<a href="{{ url('places/create') }}" class="abc" style="margin:0 0 0 38%">新增</a></h5>
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach($places as $place)
                <tr>
                    <td>{{$place->viewname}}</td>
                    <td>{{$place->note}}</td>
                    <td>{{$place->beaconid}}</td>
                    <td>{{$place->lat}}</td>
                    <td>{{$place->lng}}</td>
                    <td>{{$place->url}}</td>
                    <td>{{$place->peoplenumber}}</td>
                    <td>
                        <div style="word-wrap:break-word; word-break:break-all; display:block;">{{$place->image}}</div>
                    </td>


                    <td>
                        <a href="{{ route('places.edit',$place->id)}}" class="btn btn-primary">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('places.destroy', $place->id)}}" method="post">
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
