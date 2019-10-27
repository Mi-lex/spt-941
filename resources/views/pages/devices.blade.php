@extends('layouts.app')

@section('content')

<h3 class="title is-3">Устройства</h3>

    @foreach ($devices as $device)
        <div class="box" data-id="{{ $device->id }}">
            <article class="media">
                <div class="media-content">
                    <div class="content">
                        <p class="is-size-5">
                            <strong class="device-ip">{{ $device->ip }}:{{ $device->port }}</strong>
                            <small class="device-creation has-text-grey-light is-italic">Добавлено: {{ $device->created_at->format('d-m-Y') }}</small>
                            <br />
                            Тип соединение: <b>{{$device->connection_type}}</b>. Сетевой адресс: <b>{{ $device->device_address }}</b>
                        </p>
                    </div>
                </div>
                <div class="media-right">
                    <button class="button is-medium is-success">
                        Мониторинг
                    </button>
                    <button class="button is-medium is-warning">
                        Удалить
                    </button>
                </div>
            </article>
        </div> 
    @endforeach

@endsection

@section('scripts')
	<script src="{{ asset('js/pages/devices.js') }}"></script>
@endsection