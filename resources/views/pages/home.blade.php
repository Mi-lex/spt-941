@extends('layouts.app')

@section('content')

<div class="content is-medium">
    <h3 class="title is-3">Установка соединения</h3>
    @foreach ($errors->all() as $error)
        <article class="message is-warning">
            <div class="message-header">
                <p>Ошибка</p>
                <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
                {{ $error }}
            </div>
        </article>
    @endforeach 
    <form class="box" name="connection" method="POST" action="/">
        @csrf
        <div clas="field has-text-centered">
            <img src="{{ asset('img/connection.png') }}" width="100" />
        </div>
        <div class="field is-horizontal">
            <div class="field-body">
                <div class="field">
                    <label class="label is-medium">ip Адресс</label>
                    <div class="control has-icons-left">
                        <input name="ip" required minlength="7" maxlength="15" pattern="^([0-9]{1,3}\.){3}[0-9]{1,3}$"
                            class="input is-medium" placeholder="10.155.165.96"/>
                        <span class="icon is-small is-left">
                            <i class="fa fa-server"></i>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <label class="label is-medium">Порт</label>
                    <div class="control has-icons-left">
                        <input name="port" type="number" min="0" max="65535" class="input is-medium" placeholder="40000" required/>
                        <span class="icon is-small is-left">
                            <i class="fa fa-server"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="field is-horiaontal">
            <div class="field-body">
                <div class="field">
                    <label class="label is-medium">Сетевой адресс
                        устройства</label>
                    <div class="control has-icons-left">
                        <input name="device_address" type="number" min="0" max="99" class="input is-medium" placeholder="63" required/>
                        <span class="icon is-small is-left">
                            <i class="fa fa-sitemap"></i>
                        </span>
                    </div>
                </div>
                <div class="field is-right">
                    <div class="control">
                        <label class="label is-medium">Тип соединения</label>
                        <div class="select is-fullwidth is-medium">
                            <select name="connection_type">
                                <option>TCP</option>
                                <option>UDP</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="field deviceActions">
            <button class="button is-medium is-inverted is-outlined saveDeviceBtn" data-action="/devices">
                Сохранить устройство
            </button>
            <input type="submit" class="button is-medium is-success monitoringDeviceBtn" 
                data-action="/monitoring"/>
        </div>
    </form>
</div>

@endsection

@section('scripts')
	<script src="./js/pages/home.js"></script>
@endsection