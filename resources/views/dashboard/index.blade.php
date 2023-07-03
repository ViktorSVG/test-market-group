@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @foreach($years as $year)
                        <a type="button" href="{{route('app.index', ['year' => $year])}}" class="btn {{($current != $year ? 'btn-link' : 'btn-light')}}">{{$year}}</a>
                    @endforeach
                    <button type="button" id="new-vacation-btn" class="btn float-end btn-primary" data-bs-toggle="modal" data-bs-target="#vacation-modal">Отпуск</button>
                </div>
                <div class="card-body">
                    <table class="table table-hover vacations">
                        <colgroup>
                            <col width="20%">
                            <col width="10%">
                            <col width="70%">
                        </colgroup>
                        <thead class="table-light">
                            <tr class="table-secondary">
                                <th>Сотрудник</th>
                                <th>Должность</th>
                                <th>Отпуск(а)</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr class="{{ $user->id != \Illuminate\Support\Facades\Auth::id() ? 'table-light' : '' }}">
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->position }}</td>
                                <td>@include('dashboard.vacation', ['vacations' => explode('|', $user->vacations), 'editable' => $user->id == \Illuminate\Support\Facades\Auth::id(), 'approve' => \App\Models\Permissions::access('app.vacation.approve')])</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="vacation-approve" method="post" action="{{route('app.vacation.approve')}}" class="d-none">
    @csrf
    <input type="hidden" name="id">
    <input type="hidden" name="approve">
</form>
<form id="vacation-drop" method="post" action="{{route('app.vacation.drop')}}" class="d-none">
    @csrf
    <input type="hidden" name="id">
</form>
<div class="modal fade" id="vacation-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Отпуск</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form id="form-vacation" method="post" action="{{ route('app.vacation.save') }}">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="mb-3">
                        <label for="date_from" class="form-label">Дата с</label>
                        <input type="date" name="date_from" class="form-control" id="date_from" aria-describedby="date_from_help">
                        <div id="date_from_help" class="form-text">Мы никогда никому не передадим вашу электронную почту.</div>
                    </div>
                    <div class="mb-3">
                        <label for="date_to" class="form-label">Дата по</label>
                        <input type="date" name="date_to" class="form-control" id="date_to" aria-describedby="date_to_help">
                        <div id="date_to_help" class="form-text">Мы никогда никому не передадим вашу электронную почту.</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                <button type="submit" class="btn btn-primary" form="form-vacation">Сохранить</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="vacation-modal-drop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Удалить отпуск</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <h3>Вы уверены в удалении отпуска?</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                <button action="drop" type="button" class="btn btn-primary" form="form-vacation">Удалить</button>
            </div>
        </div>
    </div>
</div>
@endsection
