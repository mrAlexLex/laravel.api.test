@extends('layout')
@section('content')
    <h1 class="">Регистрация</h1>
    @error('formError')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <form class="col-3 offset-4" method="POST" action="{{route('tickets.registration')}}">
        @csrf
        <div class="form-group">
            <label for="text" class="col-form-label-lg">Логин</label>
            <input type="text" class="form-control" id="ftp_login" name="ftp_login" value="" placeholder="Введите логин">
            @error('ftp_login')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password" class="col-form-label-lg">Пароль</label>
            <input type="password" class="form-control" id="ftp_password" name="ftp_password" value="" placeholder="Введите пароль">
            @error('ftp_password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <button class="btn btn-lg btn-primary">Регистрация</button>
        </div>
    </form>
@endsection
@section('footer')
@endsection

