@extends('base')
<!--<link rel='stylesheet' href='https://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css'>-->
@section('main')
<div class="row">
    <div class="col-sm-12">
        <!-- <h1 class="display-3" style="margin: 20px 0 20px 35%;">靜宜景點</h1>-->

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
            <tbody>
                @foreach($places as $place)

                <tr>
                    <td width="70%">
                        <img src="{{ $place->image}}" class="img-thumbnail" width="500" />
                        <div style="word-wrap:break-word; word-break:break-all; display:block;">{{$place->viewname}}
                        </div>
                        <div style="word-wrap:break-word; word-break:break-all; display:block;">{{$place->note}}</div>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        <div>
        </div>
        @endsection
