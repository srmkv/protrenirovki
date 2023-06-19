@extends('auth.layouts.user_type.auth')
@section('page')
    {{date("d.m.Y", strtotime($day->date))}} г.
@endsection
@section('content')



    <div class="row">
        <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">

            @foreach($periods as $period)
                <div class="card mb-4" id="tools">
                    <div class="card-body">
                        <h3 class="tools-title">{{$period->name}}</h3>

                        <div class="row">
                            @foreach($period->dishes as $dish)
                                <div class="col-1">
                                    <img src="{{asset('photo/'.$dish->photo)}}" height="100" class="imgprogress">
                                    <p class="text-center">{{$dish->name}}</p>
                                </div>
                            @endforeach
                            <div class="col-1">
                                <div class="dropbox" role="button" onclick="show({{$period->id}})"
                                     data-bs-toggle="modal"
                                     data-bs-target="#modalDish">
                                    <data value="{{$period->id}}" id="{{$period->id}}"></data>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            @endforeach

            <div class="card mb-4" id="tools">
                <div class="card-body">
                    <div class="dropbox" role="button" data-bs-toggle="modal" data-bs-target="#modalPeriodDay">
                    </div>
                </div>
            </div>


        </div>
    </div>


    <!-- Modal modalPeriodDay  -->
    <div class="modal fade" id="modalPeriodDay" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Добавить прием пищи</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('PeriodDay.store', $day->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="FormName" class="form-label">Имя</label>
                            <input type="text" name="name" class="form-control" id="FormName" placeholder="Завтрак">
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

    <!-- Modal modalDish  -->
    <div class="modal fade" id="modalDish" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Добавление блюда</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('dish.store', $day->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="period_day_id" id="period_day_id">
                            <label for="ForName" class="form-label">Блюдо</label>
                            <input type="text" name="name" class="form-control" id="ForName" placeholder="Блюдо">
                        </div>
                        <div class="mb-3">
                            <label for="ForGram" class="form-label">Грамм</label>
                            <input type="number" name="gram" class="form-control" id="ForGram" placeholder="0">
                        </div>
                        <div class="mb-3">
                            <label for="ForGram" class="form-label">Белки</label>
                            <input type="number" name="protein" class="form-control" id="ForGram" placeholder="0">
                        </div>
                        <div class="mb-3">
                            <label for="ForGram" class="form-label">Жиры</label>
                            <input type="number" name="fat" class="form-control" id="ForGram" placeholder="0">
                        </div>
                        <div class="mb-3">
                            <label for="ForGram" class="form-label">Углеводы</label>
                            <input type="number" name="energy" class="form-control" id="ForGram" placeholder="0">
                        </div>
                        <div class="mb-3">
                            <label for="FormImage" class="form-label">фото</label>
                            <input type="hidden" name="type" value="before">
                            <input type="file" name="photo" class="form-control" id="FormImage" placeholder="фото">
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

    <script>
        let show = id => {
            let element = document.getElementById(id);
            document.getElementById('period_day_id').value = element.value;
        }
    </script>


@endsection
