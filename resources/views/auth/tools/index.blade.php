@extends('auth.layouts.user_type.auth')
@section('page')
    Полезные инструменты
@endsection
@section('content')
<div class="row">
    <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
      <div class="card mb-4" id="tools">
        <div class="card-body" data-bs-toggle="modal" data-bs-target="#modalbzu">
            <h5 class="tools-title">Калькулятор расчета нормы потребления калорий и БЖУ</h5>
            <p class="tools-description">Подсчет калорий и БЖУ. Правильный расчет количества калорий, белков, жиров и углеводов для достижения целей (похудение,
набор или поддержание веса)</p>
        </div>
      </div>

      <div class="card mb-4" id="tools">
        <div class="card-body">
            <h5 class="tools-title">Рабочий вес</h5>
            <p class="tools-description">Вычислить ваш рабочий вес в упражнениях</p>
        </div>
      </div>

      <div class="card mb-4" id="tools">
        <div class="card-body">
            <h5 class="tools-title">Вычислить пульс для кардио</h5>
            <p class="tools-description">Значения пульса и описание пульсовых зон</p>
        </div>
      </div>

      <div class="card mb-4" id="tools">
        <div class="card-body">
            <h5 class="tools-title">Идеальный вес</h5>
            <p class="tools-description">Идеальный вес тела</p>
        </div>
      </div>

      <div class="card mb-4" id="tools">
        <div class="card-body">
            <h5 class="tools-title">Расчет потребления воды</h5>
            <p class="tools-description">Сколько воды нужно пить в день</p>
        </div>
      </div>


      <div class="card mb-4" id="tools">
        <div class="card-body">
            <h5 class="tools-title">Индекс массы тела</h5>
            <p class="tools-description">Калькулятор расчета индекса массы тела (имт) и идеального веса для женщин и мужчин с учетом возраста</p>
        </div>
      </div>

      <div class="card mb-4" id="tools">
        <div class="card-body">
            <h5 class="tools-title">Калькулятор для штанги</h5>
            <p class="tools-description">Краткое описание калькулятора, буквально пара предложений</p>
        </div>
      </div>

    </div>
</div>



<!-- Modal modalbzu  -->
<div class="modal fade" id="modalbzu" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Калькулятор расчета нормы потребления калорий и БЖУ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('bzu.calc')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <select class="form-select" name="goal" aria-label="Default select example">
                            <option value="0.7" >Снижение веса</option>
                            <option value="1">Поддержание веса</option>
                            <option value="1.3">Набор массы</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="FormBZU" class="form-label">Вес сейчас</label>
                        <input type="number" name="weight_now" class="form-control" id="#" placeholder="Вес сейчас">
                    </div>
                    <div class="mb-3">
                        <label for="FormBZU" class="form-label">Рост</label>
                        <input type="number" name="height" class="form-control" id="#" placeholder="Рост">
                    </div>
                    <div class="mb-3">
                        <label for="FormBZU" class="form-label">Возраст</label>
                        <input type="number" name="age" class="form-control" id="#" placeholder="Возраст">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="gender" aria-label="Default select example">
                            <option selected="">Пол</option>
                            <option value="men">Мужчина</option>
                            <option value="women">Женщина</option>


                        </select>
                    </div>
                    <div class="mb-3">
                        <p class="calculate-h">Активность</p>
                    </div>
                    <div class="mb-3">
                        <input class="form-check-input calculate-check" name="activity" type="checkbox" value="1.2"  id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Практически полное отсутствие активности</label>
                        <p class="calculate-p">Сюда относятся люди с сидячим образом жизни, не занимающиеся спортом. .</p>
                    </div>
                    <div class="mb-3">
                        <input class="form-check-input calculate-check" name="activity" type="checkbox" value="1.375"  id="flexCheckDefault2">
                        <label class="form-check-label" for="flexCheckDefault2">Слабая активность</label>
                        <p class="calculate-p">Это либо сидячий образ жизни в купе с небольшими тренировками 1-3 раза в неделю,
                            либо занятия, требующие регулярной длительной ходьбы. </p>
                    </div>
                    <div class="mb-3">
                        <input class="form-check-input calculate-check" name="activity" type="checkbox" value="1.55"  id="flexCheckDefault3">
                        <label class="form-check-label" for="flexCheckDefault3">Средняя активность</label>
                        <p class="calculate-p">Этот коэффициент выбирают те, кто занимается спортом 3-4 раза в неделю по 30-60 минут. </p>
                    </div>
                    <div class="mb-3">
                        <input class="form-check-input calculate-check" name="activity" type="checkbox" value="1.7"  id="flexCheckDefault4">
                        <label class="form-check-label" for="flexCheckDefault4">Высокая активность</label>
                        <p class="calculate-p">Это ежедневные или практически ежедневные тренировки, либо занятость
                            в сфере строительства, сельского хозяйства и т.д. </p>
                    </div>
                    <div class="mb-3">
                        <input class="form-check-input calculate-check" name="activity" type="checkbox" value="1.9"  id="flexCheckDefault5">
                        <label class="form-check-label" for="flexCheckDefault5">Экстремальная активность</label>
                        <p class="calculate-p">Сюда относятся спортсмены с ежедневными многоразовыми тренировками и люди
                            с длительным рабочим днем, например, в угольных шахтах. </p>
                    </div>
                    <div class="mb-3">
                        <label for="FormBZU" class="form-label">Желаемый вес</label>
                        <input type="number" name="desired_weight" class="form-control" id="#" placeholder="Желаемый вес">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-form">Сохранить</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!--modal-->

@endsection




