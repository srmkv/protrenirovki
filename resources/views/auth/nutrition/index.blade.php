@extends('auth.layouts.user_type.auth')
@section('page')
    Моя программа питания
@endsection
@section('content')
@php

        $startDate = now();
        $endDate = now()->addDays(6);
        $currentDate = $startDate;

@endphp
<div class="d-flex justify-content-around">
@while($currentDate <= $endDate)

        <div class="d-flex align-items-center">
            <a href="{{route('nutrition', ['date' => $currentDate->format('d.m.Y')])}}"
               class="btn-head {{Request::get('date') == $currentDate->format('d.m.Y') ? 'text-dark' : '' }} mb-0" >
                {{ $currentDate->format('d.m.Y') }} г.
            </a>
        </div>

@php
$currentDate = $currentDate->addDay();
@endphp
@endwhile
</div>
    <div class="dishes">
        @foreach($dishes as $dish)
            <div class="dish-card" data-bs-toggle="modal" data-bs-target="#modalDish{{$dish->id}}">
                <div class="image-wrapper" style="background-image: url('{{ asset($dish->photo) }}')">

                </div>
                <div class="name">{{ $dish->name }}</div>
                <div class="energy">100 Г / {{ $dish->energy }} ККАЛ</div>
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
    <div class="mt-3">

    </div>

@endsection
