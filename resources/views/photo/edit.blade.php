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
        <form method="post" action="{{ route('photos.update', $place->id) }}">
            @method('PATCH')
            @csrf



            <button type="submit" class="btn btn-primary">更新資料</button>
        </form>
    </div>
</div>
@endsection
