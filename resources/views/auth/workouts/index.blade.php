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
                    <button class="btn btn-white text-success border border-success"
                            data-bs-toggle="modal" data-bs-target="#modalWorkouts">
                        Составить
                    </button>
                </div>
            </div>
        </div>
    </div>

    <form action="{{route('train.program.create')}}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- Modal modalWorkouts  -->
        <div class="modal fade" id="modalWorkouts" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Создание персональной программы</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="FormBZU" class="form-label">Возраст</label>
                            <input type="number" name="age" class="form-control" id="#" placeholder="Возраст">
                        </div>

                        <div class="mb-3">
                            <label for="FormBZU" class="form-label">Пол</label>
                            <select class="form-select" name="gender" aria-label="Default select example">
                                <option
                                    value="men">
                                    Мужчина
                                </option>
                                <option
                                    value="women">
                                    Женщина
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="FormBZU" class="form-label">Цель</label>
                            <select class="form-select" name="goal" aria-label="Default select example">
                                <option
                                    value="weight_loss">
                                    Снижение веса
                                </option>
                                <option
                                    value="weight_maintenance">
                                    Поддержание веса
                                </option>
                                <option
                                    value="mass_gain">
                                    Набор массы
                                </option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Назад</button>
                        <button type="button" class="btn btn-form" data-bs-toggle="modal"
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
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Создание персональной программы</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="FormBZU" class="form-label">Количество тренировок в неделю (от 1 до 6)</label>
                            <input type="number" name="number_of_workouts_per_week" class="form-control" min="1" max="6"
                                   id="#"
                                   placeholder="от 1 до 6">
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <p class="calculate-h">Дни недели</p>
                                </div>
                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="day[monday]" type="checkbox" id="monday">
                                    <label class="form-check-label" for="monday">
                                        Понедельник
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="day[tuesday]" type="checkbox" id="tuesday">
                                    <label class="form-check-label" for="tuesday">
                                        Вторник
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="day[wednesday]" type="checkbox" id="wednesday">
                                    <label class="form-check-label" for="wednesday">
                                        Среда
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="day[thursday]" type="checkbox" id="thursday">
                                    <label class="form-check-label" for="thursday">
                                        Четверг
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="day[friday]" type="checkbox" id="friday">
                                    <label class="form-check-label" for="friday">
                                        Пятница
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="day[saturday]" type="checkbox" id="saturday">
                                    <label class="form-check-label" for="saturday">
                                        Суббота
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="day[sunday]" type="checkbox" id="sunday">
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
                                           name="train_type" value="in_hall" type="radio" id="trainOne">
                                    <label class="form-check-label" for="trainOne">
                                        В зале
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="train_type" value="in_home" type="radio" id="trainTwo">
                                    <label class="form-check-label" for="trainTwo">
                                        Дома
                                    </label>
                                </div>


                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-form" data-bs-toggle="modal"
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
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
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
                                           name="apparatus[free_weights]" type="checkbox" id="free_weights">
                                    <label class="form-check-label" for="free_weights">
                                        Свободные веса
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[exercise_bike]" type="checkbox" id="exercise_bike">
                                    <label class="form-check-label" for="exercise_bike">
                                        Велотренажер
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[treadmill]" type="checkbox" id="treadmill">
                                    <label class="form-check-label" for="treadmill">
                                        Беговая дорожка
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[elliptical]" type="checkbox" id="elliptical">
                                    <label class="form-check-label" for="elliptical">
                                        Эллиптические тренажеры
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[stepper]" type="checkbox" id="stepper">
                                    <label class="form-check-label" for="stepper">
                                        Степпер
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[pool]" type="checkbox" id="pool">
                                    <label class="form-check-label" for="pool">
                                        Бассейн
                                    </label>
                                </div>

                                <div class="mb-3 d-flex">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[upper_and_lower_block_pull]" type="checkbox"
                                           id="upper_and_lower_block_pull">
                                    <label class="form-check-label" for="upper_and_lower_block_pull">
                                        Тяга верхнего и нижнего блока
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[butterfly_apparatus]" type="checkbox"
                                           id="butterfly_apparatus">
                                    <label class="form-check-label" for="butterfly_apparatus">
                                        Тренажер «бабочка»
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
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
                                           name="apparatus[smith_apparatus]" type="checkbox" id="smith_apparatus">
                                    <label class="form-check-label" for="smith_apparatus">
                                        Тренажер Смита
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[crossover]" type="checkbox" id="crossover">
                                    <label class="form-check-label" for="crossover">
                                        Кроссовер
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[gravitron]" type="checkbox" id="gravitron">
                                    <label class="form-check-label" for="gravitron">
                                        Гравитрон
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[linkage]" type="checkbox" id="linkage">
                                    <label class="form-check-label" for="linkage">
                                        Рычажная тяга
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[t_bar]" type="checkbox" id="t_bar">
                                    <label class="form-check-label" for="t_bar">
                                        Т-гриф
                                    </label>
                                </div>

                                <div class="mb-3 d-flex">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[apparatus_for_leg]" type="checkbox" id="apparatus_for_leg">
                                    <label class="form-check-label" for="apparatus_for_leg">
                                        Тренажер для ног
                                    </label>
                                </div>

                                <div class="mb-3 d-flex">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[apparatus_for_hand]" type="checkbox" id="apparatus_for_hand">
                                    <label class="form-check-label" for="apparatus_for_hand">
                                        Тренажер для рук
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[apparatus_gakk]" type="checkbox" id="apparatus_gakk">
                                    <label class="form-check-label" for="apparatus_gakk">
                                        Тренажер Гакк
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[apparatus_platform]" type="checkbox" id="apparatus_platform">
                                    <label class="form-check-label" for="apparatus_platform">
                                        Тренажер-платформа
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[apparatus_for_calf]" type="checkbox" id="apparatus_for_calf">
                                    <label class="form-check-label" for="apparatus_for_calf">
                                        Тренажеры для икр
                                    </label>
                                </div>

                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Назад</button>
                        <button type="button" class="btn btn-form" data-bs-toggle="modal"
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
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Создание персональной программы</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <p class="calculate-h">Оборудования дома</p>
                                </div>
                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[bench_with_slope]" type="checkbox" id="bench_with_slope">
                                    <label class="form-check-label" for="bench_with_slope">
                                        Скамья с уклоном
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[bench_without_slope]" type="checkbox"
                                           id="bench_without_slope">
                                    <label class="form-check-label" for="bench_without_slope">
                                        Скамья без уклона
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[free_weight_dumbbells]" type="checkbox"
                                           id="free_weight_dumbbells">
                                    <label class="form-check-label" for="free_weight_dumbbells">
                                        Свободные веса гантели
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[free_weight_rods]" type="checkbox" id="free_weight_rods">
                                    <label class="form-check-label" for="free_weight_rods">
                                        Свободные веса штанги
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[free_weight_kettlebell]" type="checkbox"
                                           id="free_weight_kettlebell">
                                    <label class="form-check-label" for="free_weight_kettlebell">
                                        Свободные веса гири
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[horizontal_bar]" type="checkbox" id="horizontal_bar">
                                    <label class="form-check-label" for="horizontal_bar">
                                        Турник
                                    </label>
                                </div>

                                <div class="mb-3 d-flex">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[bars]" type="checkbox" id="bars">
                                    <label class="form-check-label" for="bars">
                                        Брусья
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <input class="form-check-input calculate-check"
                                           name="apparatus[platform]" type="checkbox" id="platform">
                                    <label class="form-check-label" for="platform">
                                        Платформа
                                    </label>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <p class="calculate-h">Другое</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="apparatus_comment">
                                        Напишите список тренажеров
                                    </label>
                                    <textarea class="form-control"
                                              name="apparatus_comment" type="checkbox" id="apparatus_comment">
                                    </textarea>

                                </div>


                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Назад</button>
                        <button type="button" class="btn btn-form" data-bs-toggle="modal"
                                data-bs-target="#modalWorkouts5">
                            Далее
                        </button>
                    </div>


                </div>
            </div>
        </div>
        <!--modal-->

        <!-- Modal modalWorkouts5  -->
        <div class="modal" id="modalWorkouts5" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Создание персональной программы</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            @foreach($rates as $rate)
                                <div class="col-xs-12 col-sm-6 mb-2">
                                    <div class="tarif_card card text-center">
                                        <p class="tarif-card-txt"><span class="tarif-head">{{$rate->name}}</span></p>
                                        <p class="tarif-price-txt"><span class="tarif-price">{{$rate->price}} ₽</span> /
                                            день</p>
                                        <p class="tarif-card-content">{{$rate->hint}}</p>
                                        <p class="tarif-card-content">Действует до:</p>
                                        <p class="tarif-card-date">27 февраля, 2023</p>
                                        <button type="submit"
                                                class="tarif-card-btn">Купить
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--modal-->


    </form>

@endsection
