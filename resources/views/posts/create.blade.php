@extends('layout')
@section('content')
<form action="{{route('posts.store')}}" method="POST">

    @csrf


    <div class="form-group">
        <label> Nome </label>
        <input type="text" name="name" class="form-control" value="{{old('name')}}"/>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control" value="{{old('email')}}">
    </div>
    
    <div class="form-group">
        <label>Cidade</label>
        <input type="text" name="city" class="form-control" value="{{old('city')}}">
    </div>

    <div class="form-group">
        <label>Recado</label><br>
        <textarea name="message" cols="30" rows="10" class="form-control">{{old('message')}}</textarea>
    </div>

    <button class="btn btn-lg btn-success">Publicar Recado</button>
</form>
@endsection