@extends('layouts.app')

@section('content')
    <h3 class="title is-3">Мониторинг</h3>
    <form class="is-hidden" name="connectionParamsForm">
        @csrf
        <input type="hidden" name="ip" value={{ $connection['ip'] }}>
        <input type="hidden" name="port" value={{ $connection['port'] }}>
        <input type="hidden" name="connection_type" value={{ $connection['connection_type'] }}>
        <input type="hidden" name="device_address" value={{ $connection['device_address'] }}>
    </form>
    <div class="box monitoring-box">
        <div class="columns">
            <div class="column is-two-thirds">
                <div class="columns is-multiline is-centered">
                    
                    <div class="column is-half">
                        <div class="consumptionCard">
                            <span class="consumptionCard__icon consumptionCard__icon--blue">V</span>
                    
                            <p class="consumptionCard__title">
                                Объем
                            </p>
                            <strong class="consumptionCard__value">
                                <span class="digit value-v">-</span>
                                <small class="device__units">м<sup>3</sup></small>
                            </strong>
                        </div>
                    </div>
                    <div class="column is-half">
                        <div class="consumptionCard">
                            <span class="consumptionCard__icon consumptionCard__icon--green">m</span>
                    
                            <p class="consumptionCard__title">
                                Масса
                            </p>
                            <strong class="consumptionCard__value">
                                <span class="digit value-m">-</span>
                                <small class="device__units">т</small>
                            </strong>
                        </div>
                    </div>
                    <div class="column is-half">
                        <div class="consumptionCard">
                            <span class="consumptionCard__icon consumptionCard__icon--red">t1</span>
                    
                            <p class="consumptionCard__title">
                                Температура 1
                            </p>
                            <strong class="consumptionCard__value">
                                <span class="digit value-t1">-</span>
                                <small class="device__units">°C</small>
                            </strong>
                        </div>
                    </div>
                    <div class="column is-half">
                        <div class="consumptionCard">
                            <span class="consumptionCard__icon consumptionCard__icon--red">t2</span>
                    
                            <p class="consumptionCard__title">
                                Температура 2
                            </p>
                            <strong class="consumptionCard__value">
                                <span class="digit value-t2">-</span>
                                <small class="device__units">°C</small>
                            </strong>
                        </div>
                    </div>
                    <div class="column is-two-thirds">
                        <div class="consumptionCard">
                            <span class="consumptionCard__icon consumptionCard__icon--orange">Q</span>
                    
                            <p class="consumptionCard__title">
                                Тепловая энергия
                            </p>
                            <strong class="consumptionCard__value">
                                <span class="digit value-sn">-</span>
                                <small class="device__units">ГКал</small>
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-one-third">
                <button class="button is-medium is-success is-fullwidth monitoringBtn">
                    <!-- <span class="icon">
                            <i
                                class="fa fa-spinner fa-pulse"
                            ></i>
                        </span> -->
                    Начать мониторинг
                </button>
                <figure class="image is-fullwidth spt-frame">
                    <img src="/img/spt941.jpg" alt="Изображение устройства" />
                </figure>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
	<script src="{{ asset('js/pages/monitoring.js') }}"></script>
@endsection