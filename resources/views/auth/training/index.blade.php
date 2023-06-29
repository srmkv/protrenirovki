@extends('auth.layouts.user_type.auth')
@section('page')
    Дневник тренировок
    <div class="d-flex align-items-center">
        <button class="btn-head mb-0" data-bs-toggle="modal" data-bs-target="#modalDayTraining">
            <i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Добавить день
        </button>
    </div>
@endsection
@section('content')

    <style>
        * {
            box-sizing: border-box;
        }

        ul {
            list-style-type: none;
        }

        body {
            font-family: Verdana, sans-serif;
        }


        .weekdays {
            margin: 0;
            padding: 10px 0;
            background-color: #FFFFFF;
        }

        .weekdays li {
            display: inline-block;
            width: 13.6%;
            color: #000000;
            text-align: center;
        }

        .days {
            padding: 10px 0;
            background: #FFFFFF;
            margin: 0;
        }

        .days li {
            list-style-type: none;
            display: inline-block;
            width: 13.6%;
            height: 60px;
            text-align: center;
            font-size: 12px;
            color: #000000;
            border: 1px solid #CCD1D9;
            border-collapse: collapse;
        }

        .days li .active {
            padding: 5px;
            background: #6D6443;
            border-radius: 32px;
            color: white !important
        }

        .days li .relax {
            padding: 5px;
            background: #B0CE66;
            border-radius: 32px;
            color: white !important
        }

        /* Add media queries for smaller screens */
        @media screen and (max-width: 720px) {
            .weekdays li, .days li {
                width: 13.1%;
            }
        }

        @media screen and (max-width: 420px) {
            .weekdays li, .days li {
                width: 12.5%;
            }

            .days li .active {
                padding: 2px;
            }
        }

        @media screen and (max-width: 290px) {
            .weekdays li, .days li {
                width: 12.2%;
            }
        }
    </style>


    <div class="row">
        <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">

            @isset($program)
                <table>
                    <ul class="weekdays">
                        <li>Пн</li>
                        <li>Вт</li>
                        <li>Ср</li>
                        <li>Чт</li>
                        <li>Пт</li>
                        <li>Сб</li>
                        <li>Вс</li>
                    </ul>

                    <ul class="days">


                        @for($i = $losDayCount; $i >= 1; $i--)

                            <li>X
                                <div>
                                    <span class="relax text-nowrap">отдых</span>
                                </div>
                            </li>

                        @endfor

                        @foreach($days as $day)
                            @if($day->description == 'отдых')
                                <li>{{date("d", strtotime($day->date))}}
                                    <div>
                                        <span class="relax text-nowrap">{{$day->description}}</span>
                                    </div>
                                </li>
                            @else
                                <a href="{{route('training.day',$day->id)}}">
                                    <li>{{date("d", strtotime($day->date))}}
                                        <div>
                                            <span class="active text-nowrap">{{$day->description}}</span>
                                        </div>
                                    </li>
                                </a>
                            @endif
                        @endforeach
                    </ul>
                </table>
            @endisset
        </div>
    </div>


    <!-- Modal modalDayTraining  -->
    <div class="modal fade" id="modalDayTraining" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Добавить день</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('DayTraining.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="FormWeight" class="form-label">Описание</label>
                            <input type="text" name="description" class="form-control" id="FormWeight"
                                   placeholder="Сгибания ног">
                        </div>
                        <div class="mb-3">
                            <label for="ForDate" class="form-label">Дата</label>
                            <input type="date" name="date" class="form-control" id="ForDate" placeholder="Дата">
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
