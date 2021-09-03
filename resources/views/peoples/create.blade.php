@extends('base')
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3"align="center">搜尋景點人數</h1>
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
            <form method="post" action="{{ route('peoples.store') }}">
                @csrf
                <div class="form-group">
                    <label for="logtime">
                        <font size="7">日期:(ex:xxxx-xx-xx)</font>
                    </label>
                    <input type="text" class="form-control" name="logtime" />
                </div>
                <div class="form-group">
                    <label for="aid">
                        <font size="7">景點:</font>
                    </label>
                    <select name="aid" style="font-size:35px;">
                        <option value=1>景點1</option>
                        <option value=2>景點2</option>
                        <option value=3>景點3</option>
                        <option value=4>景點4</option>
                        <option value=5>景點5</option>
                        <option value=6>景點6</option>
                        <option value=7>景點7</option>
                        <option value=8>景點8</option>
                        <option value=9>景點9</option>
                        <option value=10>景點10</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    <font size="5">查詢</font>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection