@extends('auth.layouts.user_type.auth')
@section('page')
    Мои программы тренировок
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
            <div class="tarif_card card text-center">
                <div class="offset-4 col-4 mt-12 mb-12">
                    <h3>Составьте индивидуальную программу тренировок</h3>
                    @if($bju)
                        <button class="btn btn-white text-success border border-success"
                                data-bs-toggle="modal" data-bs-target="#modalWorkouts">
                            Составить
                        </button>
                    @else
                        <a href="{{route('tools')}}" class="btn btn-info">
                            Чтобы использовать прогамму тренировок, вам нужно пройти через калкулятор калорий и БЖУ в разделе "Полезные
                            инструменты"
                        </a>

                    @endif


                </div>
            </div>
        </div>
    </div>

    <form action="{{route('train.program.create')}}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- Modal modalWorkouts  -->
        <div class="modal fade" id="modalWorkouts" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true" style="padding-left: 20%;">

            <div class="modal-dialog modal-dialog-centered">

                <img src="{{asset('dist/images/girlb.png')}}" height="490" style="
    position: absolute;
    z-index: -100;
    margin-left: -320px;
    margin-top: 20px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Создание персональной программы</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="FormBZU" class="form-label">Возраст</label>
                            <input type="number" name="age" @isset($bju) value="{{$bju->age}}" @endisset class="form-control" id="#" placeholder="Возраст">
                        </div>

                        <div class="mb-3">
                            <label for="FormBZU" class="form-label">Пол</label>
                            <select class="form-select" name="gender" aria-label="Default select example">
                                <option
                                    @isset($bju)
                                    {{$bju->gender == "men" ? 'selected' : ''}}
                                    @endisset
                                    value="men">
                                    Мужчина
                                </option>
                                <option
                                    @isset($bju)
                                    {{$bju->gender == "women" ? 'selected' : ''}}
                                    @endisset
                                    value="women">
                                    Женщина
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="FormBZU" class="form-label">Цель</label>
                            <select class="form-select" name="goal" aria-label="Default select example">
                                <option
                                    @isset($program)
                                    {{$program->goal == "weight_loss" ? 'selected' : ''}}
                                    @endisset
                                    value="weight_loss">
                                    Снижение веса
                                </option>
                                <option
                                    @isset($program)
                                    {{$program->goal == "weight_maintenance" ? 'selected' : ''}}
                                    @endisset
                                    value="weight_maintenance">
                                    Поддержание веса
                                </option>
                                <option
                                    @isset($program)
                                    {{$program->goal == "mass_gain" ? 'selected' : ''}}
                                    @endisset
                                    value="mass_gain">
                                    Набор массы
                                </option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Назад</button>
                        <button type="button" id="btn_modal_1" class="btn btn-form" data-bs-toggle="modal"
                                data-bs-target="#modalWorkouts2">
                            Далее
                        </button>
                    </div>


                </div>
            </div>


        </div>
        <!--modal-->

        <!-- Modal modalWorkouts2  -->
        <div class="modal" id="modalWorkouts2" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true" style="margin-left: 15%">
            <div class="modal-dialog modal-dialog-centered">
                <img src="{{asset('dist/images/girlb.png')}}" height="630" style="
    position: absolute;
    z-index: -100;
    margin-left: -420px;
    margin-top: 26px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Создание персональной программы</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <input type="hidden" name="number_of_workouts_per_week" class="form-control" min="1" max="5"
                                   id="number_of_workouts_per_week_input_id"
                                   @isset($program)
                                   value="{{$program->number_of_workouts_per_week}}"
                                   @endisset
                                   placeholder="от 1 до 5">
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <p class="calculate-h">Дни недели</p>
                                </div>
                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->day)->Mon)
                                           {{\GuzzleHttp\json_decode($program->day)->Mon == "Mon" ? 'checked' : ''}}
                                           @endisset
                                           @endisset

                                           name="day[Mon]" value="Mon" type="checkbox" checked id="monday">
                                    <label class="form-check-label" for="monday">
                                        Понедельник
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->day)->Tue)
                                           {{\GuzzleHttp\json_decode($program->day)->Tue == "Tue" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="day[Tue]" value="Tue" type="checkbox" id="tuesday">
                                    <label class="form-check-label" for="tuesday">
                                        Вторник
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->day)->Wed)
                                           {{\GuzzleHttp\json_decode($program->day)->Wed == "Wed" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="day[Wed]" value="Wed" type="checkbox" id="wednesday">
                                    <label class="form-check-label" for="wednesday">
                                        Среда
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->day)->Thu)
                                           {{\GuzzleHttp\json_decode($program->day)->Thu == "Thu" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="day[Thu]" value="Thu" type="checkbox" id="thursday">
                                    <label class="form-check-label" for="thursday">
                                        Четверг
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->day)->Fri)
                                           {{\GuzzleHttp\json_decode($program->day)->Fri == "Fri" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="day[Fri]" value="Fri" type="checkbox" id="friday">
                                    <label class="form-check-label" for="friday">
                                        Пятница
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->day)->Sat)
                                           {{\GuzzleHttp\json_decode($program->day)->Sat == "Sat" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="day[Sat]" value="Sat" type="checkbox" id="saturday">
                                    <label class="form-check-label" for="saturday">
                                        Суббота
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->day)->Sun)
                                           {{\GuzzleHttp\json_decode($program->day)->Sun == "Sun" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="day[Sun]" value="Sun" type="checkbox" id="sunday">
                                    <label class="form-check-label" for="sunday">
                                        Воскресенье
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <p class="calculate-h">Тренировка</p>
                                </div>
                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           {{$program->train_type == "in_hall" ? 'checked' : ''}}
                                           @endisset
                                           name="train_type" value="in_hall" checked type="radio" id="trainOne">
                                    <label class="form-check-label" for="trainOne">
                                        В зале
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           {{$program->train_type == "in_home" ? 'checked' : ''}}
                                           @endisset
                                           name="train_type" value="in_home" type="radio" id="trainTwo">
                                    <label class="form-check-label" for="trainTwo">
                                        Дома
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <p class="calculate-h">Опыт тренировок</p>
                                </div>
                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="experience" value="beginner" checked type="radio" id="beginner">
                                    <label class="form-check-label" for="beginner">
                                        Новичок (до 6 месяцев)
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="experience" value="experienced" type="radio" id="experienced">
                                    <label class="form-check-label" for="experienced">
                                        Опытный (от 6 до 18 месяцев)
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="experience" value="pro" type="radio" id="pro">
                                    <label class="form-check-label" for="pro">
                                        Профи (от 18 до 36 месяцев)
                                    </label>
                                </div>
                                <div class="mb-3 d-flex">
                                    <input class="form-check-input calculate-check"
                                           name="experience" value="super_pro" type="radio" id="super_pro">
                                    <label class="form-check-label" for="super_pro">
                                        Супер профи (свыше 36 месяцев)
                                    </label>
                                </div>

                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" id="btn_modal_2" class="btn btn-form" data-bs-toggle="modal"
                                data-bs-target="#modalWorkouts3">
                            Далее
                        </button>
                    </div>


                </div>
            </div>
        </div>
        <!--modal-->

        <!-- Modal modalWorkouts3  -->
        <div class="modal" id="modalWorkouts3" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true" style="margin-left: 15%">
            <div class="modal-dialog modal-dialog-centered">

                <img src="{{asset('dist/images/girlb.png')}}" height="740" style="
    position: absolute;
    z-index: -100;
    margin-left: -420px;
    margin-top: 34px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Создание персональной программы</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <p class="calculate-h">Тренажеры в зале</p>
                                </div>
                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->free_weights)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->free_weights == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[free_weights]" checked type="checkbox" id="free_weights">
                                    <label class="form-check-label" for="free_weights">
                                        Свободные веса
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->exercise_bike)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->exercise_bike == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[exercise_bike]" type="checkbox" id="exercise_bike">
                                    <label class="form-check-label" for="exercise_bike">
                                        Велотренажер
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->treadmill)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->treadmill == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[treadmill]" type="checkbox" id="treadmill">
                                    <label class="form-check-label" for="treadmill">
                                        Беговая дорожка
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->elliptical)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->elliptical == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[elliptical]" type="checkbox" id="elliptical">
                                    <label class="form-check-label" for="elliptical">
                                        Эллиптические тренажеры
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->stepper)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->stepper == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[stepper]" type="checkbox" id="stepper">
                                    <label class="form-check-label" for="stepper">
                                        Степпер
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->pool)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->pool == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[pool]" type="checkbox" id="pool">
                                    <label class="form-check-label" for="pool">
                                        Бассейн
                                    </label>
                                </div>

                                <div class="mb-3 d-flex">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->upper_and_lower_block_pull)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->upper_and_lower_block_pull == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[upper_and_lower_block_pull]" type="checkbox"
                                           id="upper_and_lower_block_pull">
                                    <label class="form-check-label" for="upper_and_lower_block_pull">
                                        Тяга верхнего и нижнего блока
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->butterfly_apparatus)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->butterfly_apparatus == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[butterfly_apparatus]" type="checkbox"
                                           id="butterfly_apparatus">
                                    <label class="form-check-label" for="butterfly_apparatus">
                                        Тренажер «бабочка»
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->hammer_apparatus)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->hammer_apparatus == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[hammer_apparatus]" type="checkbox" id="hammer_apparatus">
                                    <label class="form-check-label" for="hammer_apparatus">
                                        Тренажер Хаммера
                                    </label>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <p class="calculate-h"></p>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->smith_apparatus)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->smith_apparatus == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[smith_apparatus]" type="checkbox" id="smith_apparatus">
                                    <label class="form-check-label" for="smith_apparatus">
                                        Тренажер Смита
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->crossover)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->crossover == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[crossover]" type="checkbox" id="crossover">
                                    <label class="form-check-label" for="crossover">
                                        Кроссовер
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->gravitron)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->gravitron == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[gravitron]" type="checkbox" id="gravitron">
                                    <label class="form-check-label" for="gravitron">
                                        Гравитрон
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->linkage)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->linkage == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[linkage]" type="checkbox" id="linkage">
                                    <label class="form-check-label" for="linkage">
                                        Рычажная тяга
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->t_bar)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->t_bar == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[t_bar]" type="checkbox" id="t_bar">
                                    <label class="form-check-label" for="t_bar">
                                        Т-гриф
                                    </label>
                                </div>

                                <div class="mb-3 d-flex">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->apparatus_for_leg)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->apparatus_for_leg == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[apparatus_for_leg]" type="checkbox" id="apparatus_for_leg">
                                    <label class="form-check-label" for="apparatus_for_leg">
                                        Тренажер для ног
                                    </label>
                                </div>

                                <div class="mb-3 d-flex">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->apparatus_for_hand)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->apparatus_for_hand == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[apparatus_for_hand]" type="checkbox" id="apparatus_for_hand">
                                    <label class="form-check-label" for="apparatus_for_hand">
                                        Тренажер для рук
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->apparatus_gakk)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->apparatus_gakk == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[apparatus_gakk]" type="checkbox" id="apparatus_gakk">
                                    <label class="form-check-label" for="apparatus_gakk">
                                        Тренажер Гакк
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->apparatus_platform)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->apparatus_platform == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[apparatus_platform]" type="checkbox" id="apparatus_platform">
                                    <label class="form-check-label" for="apparatus_platform">
                                        Тренажер-платформа
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->apparatus_for_calf)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->apparatus_for_calf == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[apparatus_fotrr_calf]" type="checkbox" id="apparatus_for_calf">
                                    <label class="form-check-label" for="apparatus_for_calf">
                                        Тренажеры для икр
                                    </label>
                                </div>

                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Назад</button>
                        <button type="button" id="btn_modal_3" class="btn btn-form" data-bs-toggle="modal"
                                data-bs-target="#modalWorkouts4">
                            Далее
                        </button>
                    </div>


                </div>
            </div>
        </div>
        <!--modal-->

        <!-- Modal modalWorkouts4  -->
        <div class="modal" id="modalWorkouts4" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true" style="margin-left: 15%;">
            <div class="modal-dialog modal-dialog-centered">
                <img src="{{asset('dist/images/girlb.png')}}" height="635" style="
    position: absolute;
    z-index: -100;
    margin-left: -420px;
    margin-top: 28px;">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Создание персональной программы</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
{{--                                    <p class="calculate-h">Оборудования дома</p>--}}
                                </div>
                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->bench_with_slope)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->bench_with_slope == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[bench_with_slope]" type="checkbox" checked
                                           id="bench_with_slope">
                                    <label class="form-check-label" for="bench_with_slope">
                                        Скамья с уклоном
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->bench_without_slope)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->bench_without_slope == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[bench_without_slope]" type="checkbox"
                                           id="bench_without_slope">
                                    <label class="form-check-label" for="bench_without_slope">
                                        Скамья без уклона
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->free_weight_dumbbells)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->free_weight_dumbbells == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[free_weight_dumbbells]" type="checkbox"
                                           id="free_weight_dumbbells">
                                    <label class="form-check-label" for="free_weight_dumbbells">
                                        Свободные веса гантели
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->free_weight_rods)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->free_weight_rods == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[free_weight_rods]" type="checkbox" id="free_weight_rods">
                                    <label class="form-check-label" for="free_weight_rods">
                                        Свободные веса штанги
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->free_weight_kettlebell)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->free_weight_kettlebell == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[free_weight_kettlebell]" type="checkbox"
                                           id="free_weight_kettlebell">
                                    <label class="form-check-label" for="free_weight_kettlebell">
                                        Свободные веса гири
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->horizontal_bar)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->horizontal_bar == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[horizontal_bar]" type="checkbox" id="horizontal_bar">
                                    <label class="form-check-label" for="horizontal_bar">
                                        Турник
                                    </label>
                                </div>

                                <div class="mb-3 d-flex">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->bars)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->bars == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[bars]" type="checkbox" id="bars">
                                    <label class="form-check-label" for="bars">
                                        Брусья
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           @isset($program)
                                           @isset(\GuzzleHttp\json_decode($program->apparatus)->platform)
                                           {{\GuzzleHttp\json_decode($program->apparatus)->platform == "on" ? 'checked' : ''}}
                                           @endisset
                                           @endisset
                                           name="apparatus[platform]" type="checkbox" id="platform">
                                    <label class="form-check-label" for="platform">
                                        Платформа
                                    </label>
                                </div>

                            </div>
{{--                            <div class="col-6">--}}
{{--                                <div class="mb-3">--}}
{{--                                    <p class="calculate-h">Другое</p>--}}
{{--                                </div>--}}
{{--                                <div class="mb-3">--}}
{{--                                    <textarea class="form-control"--}}
{{--                                              name="apparatus_comment" type="checkbox" id="apparatus_comment">Напишите список тренажеров--}}
{{--                                        @isset($program)--}}
{{--                                            {{$program->apparatus_comment}}--}}
{{--                                        @endisset--}}
{{--                                    </textarea>--}}

{{--                                </div>--}}


{{--                            </div>--}}
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Назад</button>

                            <button type="submit" id="btn_modal_4" class="btn btn-form" data-bs-toggle="modal"
                                    data-bs-target="#modalWorkouts5">
                                Далее
                            </button>


{{--                        @if(Auth::user()->traffic == 'Free')--}}
{{--                            <button type="button" id="btn_modal_4" class="btn btn-form" data-bs-toggle="modal"--}}
{{--                                    data-bs-target="#modalWorkouts5">--}}
{{--                                Далее--}}
{{--                            </button>--}}
{{--                        @else--}}
{{--                            <button type="submit"  class="btn btn-form">--}}
{{--                                Далее--}}
{{--                            </button>--}}
{{--                        @endif--}}



                    </div>


                </div>
            </div>
        </div>
        <!--modal-->

        <!-- Modal modalWorkouts5  -->
{{--        <div class="modal" id="modalWorkouts5" tabindex="-1" aria-labelledby="exampleModalCenterTitle"--}}
{{--             aria-hidden="true" style="margin-left: 15%;">--}}
{{--            <div class="modal-dialog modal-dialog-centered">--}}
{{--                <img src="{{asset('dist/images/girlb.png')}}" height="660" style="--}}
{{--    position: absolute;--}}
{{--    z-index: -100;--}}
{{--    margin-left: -420px;--}}
{{--    margin-top: 24px;">--}}
{{--                <div class="modal-content">--}}
{{--                    <div class="modal-header">--}}
{{--                        <h5 class="modal-title" id="exampleModalCenterTitle">Создание персональной программы</h5>--}}
{{--                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                    </div>--}}

{{--                    <div class="modal-body">--}}
{{--                        <div class="row" style="height:510px; overflow: scroll;">--}}
{{--                            @foreach($rates as $rate)--}}
{{--                                <div class="col-xs-12 col-sm-6 mb-2">--}}
{{--                                    <div class="tarif_card card text-center">--}}
{{--                                        <p class="tarif-card-txt"><span class="tarif-head">{{$rate->name}}</span></p>--}}
{{--                                        <p class="tarif-price-txt"><span class="tarif-price">{{$rate->price}} ₽</span> /--}}
{{--                                            день</p>--}}
{{--                                        <p class="tarif-card-content">{{$rate->hint}}</p>--}}
{{--                                        <p class="tarif-card-content">Действует до:</p>--}}
{{--                                        <p class="tarif-card-date">27 февраля, 2023</p>--}}
{{--                                        <button type="submit"--}}
{{--                                                class="tarif-card-btn">Купить--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!--modal-->


    </form>

    <script>

        // Hide last popups
        function hidePopup(button_id, popup_id) {
            document.getElementById(button_id).addEventListener("click", hideLastPopup);

            function hideLastPopup() {
                document.getElementById(popup_id).style.display = "none";
            }
        }

        hidePopup("btn_modal_1", "modalWorkouts");
        hidePopup("btn_modal_2", "modalWorkouts2");
        hidePopup("btn_modal_3", "modalWorkouts3");
        hidePopup("btn_modal_4", "modalWorkouts4");

        // validate days of week for train

        // validate days of week for train
        var daysCountObject = document.getElementById("number_of_workouts_per_week_input_id");
        daysCountObject.addEventListener("keyup", daysCount);
        var dayFromInput = parseInt(daysCountObject.value);
        function daysCount(){
            dayFromInput =  parseInt(daysCountObject.value);
            dayTrigger();
        }

        var daySum = 0;
        if(parseInt(daysCountObject.value)){
            var daySum = parseInt(daysCountObject.value);
        } else{
            var daySum = 0;
        }

        function dayEventListener(day){
            var checkbox = document.getElementById(day);
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    daySum +=1;
                } else {
                    daySum -=1;
                }
                dayTrigger();
            })
        }
        function dayTrigger(){
            if(daySum === 5){
                disabledAllDays();
            }else{
                openAllDays();
            }
        }
        function disabledAllDays(){

            function openCheckbox(day){
                var checkbox = document.getElementById(day);
                if(checkbox.checked){
                    checkbox.disabled = false;
                } else {
                    checkbox.disabled = true;
                }
            }

            openCheckbox("monday");
            openCheckbox("tuesday");
            openCheckbox("wednesday");
            openCheckbox("thursday");
            openCheckbox("friday");
            openCheckbox("saturday");
            openCheckbox("sunday");

        }
        function openAllDays(){
            document.getElementById("monday").disabled = false;
            document.getElementById("tuesday").disabled = false;
            document.getElementById("wednesday").disabled = false;
            document.getElementById("thursday").disabled = false;
            document.getElementById("friday").disabled = false;
            document.getElementById("saturday").disabled = false;
            document.getElementById("sunday").disabled = false;
        }
        dayTrigger();
        dayEventListener("monday");
        dayEventListener("tuesday");
        dayEventListener("wednesday");
        dayEventListener("thursday");
        dayEventListener("friday");
        dayEventListener("saturday");
        dayEventListener("sunday");

    </script>
@endsection
