@extends('layout')
@section('content')
    <div class="d-flex justify-content-between align-items-center py-3">
        <h2 class="h5 mb-0"><a href="#" class="text-muted"></a>Добавить тикет</h2>
    </div>
    <div class="row">
        <form class="col-10 offset-1" method="POST" action="@if(!isset($ticket)) {{route('tickets.create')}} @else {{route('tickets.update', $ticket['id'])}} @endif">
            @csrf
            <div class="form-group">
                <label for="text" class="col-form-label-lg">Тема</label>
                <input type="text" class="form-control" id="subject" name="subject" value="{{ isset($ticket) ? $ticket['subject'] : '' }}" placeholder="Введите тему">
                @error('subject')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="text" class="col-form-label-lg">Имя пользователя</label>
                <input type="text" class="form-control" id="user_name" name="user_name" value="{{ isset($ticket) ? $ticket['user_name'] : '' }}" placeholder="Введите имя">
                @error('user_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="text" class="col-form-label-lg">Email пользователя</label>
                <input type="text" class="form-control" id="user_email" name="user_email" value="{{ isset($ticket) ? $ticket['user_email'] : '' }}" placeholder="Введите email">
                @error('user_email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="row">
                <div class="form-group">
                    <button class="btn btn-outline-primary col-2 offset-10">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('footer')

@endsection
