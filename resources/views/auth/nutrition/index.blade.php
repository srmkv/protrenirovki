@extends('auth.layouts.user_type.auth')
@section('page')
    Моя программа питания

    <div class="d-flex align-items-center">
        <button class="btn-head mb-0" data-bs-toggle="modal" data-bs-target="#modalNutrition">
            <i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Добавить день
        </button>
    </div>

@endsection
@section('content')
</div>
    @isset($dishes)

        <div class="d-flex align-items-center">
            <p class="btn-head mb-0 text-dark">
                {{date("d.m.Y", strtotime($date->date))}} г.
            </p>
            <a href="{{route('food')}}" class="btn-head ql-size-large">
                Добавить все
            </a>
        </div>

    <div class="dishes">
        @foreach($dishes as $dish)
            <div class="dish-card">
                <div class="image-wrapper" style="background-image: url('{{ asset($dish->photo) }}')">

                </div>
                <div class="name" data-bs-toggle="modal" data-bs-target="#modalDish{{$dish->id}}">{{ $dish->name }}</div>
                <div class="energy mb-4">100 Г / {{ $dish->energy }} ККАЛ</div>

                <a href="{{route('nutrition', ['dish_id' => $dish->dish_id] )}}" class="btn-head">
                    Изменить
                </a>

            </div>

            <div class="modal fade" id="modalDish{{$dish->id}}" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">{{ $dish->name }}</h5>
                        </div>
                        <p class="mt-3 mb-3">
                            {{ $dish->description }}
                        </p>
                        <img src="{{ asset($dish->photo) }}" width="100%">
                        <div class="d-flex justify-content-between mt-3">
                            <div>Время приготовления</div>
                            <span class="fw-bold">{{ $dish->cooking_time }}</span>
                        </div>
                        <div class="line"></div>
                        <div class="">
                            <h4>Ингредиенты</h4>
                            <div class="ingredients">
                                @foreach($dish->ingredients as $ingredient)
                                    <div class="d-flex justify-content-between p-2 border-bottom">
                                        <span>{{ $ingredient->name }} {{$ingredient->pivot->information}}</span>
                                        <span>{{ $ingredient->pivot->quantity }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="">
                            <h4 class="mb-2 mt-3">Приготовление</h4>
                            @foreach($dish->steps as $step)
                                <div class="border-bottom p-3">
                                    <h3>{{ $loop->index + 1 }}.</h3>
                                    {!! $step !!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div>

    @endisset


    <!-- Modal modalNutrition  -->
    <div class="modal fade" id="modalNutrition" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Добавить день</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('nutrition')}}" method="get">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="ForDate" class="form-label">Дата</label>
                            <input type="date" name="date" class="form-control" id="ForDate" placeholder="Дата">
                        </div>
                        <div class="mb-3">
                            <label for="FormWeight" class="form-label">Количество приёма пиши</label>
                            <input type="number" name="dishCount" min="1" max="8" class="form-control" id="FormWeight" placeholder="Количество приёма пиши">
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
