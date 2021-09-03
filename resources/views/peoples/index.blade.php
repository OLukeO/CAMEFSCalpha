@extends('base')
@section('main')
<div class="row">
    <div class="col-sm-12">
        <h1 class="display-3" align="center">人流資料 <a href="{{ route('peoples.create')}}" class="btn btn-primary">查詢</a></h1>
        
        <table class="table table-striped">
            <thead>
                <tr align="center">
                    <td><font size="6">景點</font></td>
                    <td><font size="6">時間</font></td>
                    <td><font size="6">人數</font></td>
                </tr>
            </thead>
            <tbody>
                @foreach($peoples as $people)
                @foreach($positions as $position)
                <tr align="center">
                    <td><font size="4">{{$position->viewname}}</font></td>
                    <td><font size="4">{{$people->logtime}}</font></td>
                    <td><font size="4">{{$people->peoplenumber}}</font></td>
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
        <div>
        </div>
        @endsection