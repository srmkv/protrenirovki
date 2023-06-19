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
<div class="modal fade" id="modalbzu" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Калькулятор БЖУ</h5>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
@endsection




