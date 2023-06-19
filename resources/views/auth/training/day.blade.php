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

                            @foreach($period->approaches as $approach)
                                <div class="col-1 mt-4">
                                    <h6 class="text-center">{{$approach->kg}} кг</h6>
                                    <h6 class="text-center">{{$approach->repeat}} пвт</h6>
                                </div>
                            @endforeach

                            <div class="col-1">
                                <div class="dropbox" role="button" onclick="show({{$period->id}})"
                                     data-bs-toggle="modal"
                                     data-bs-target="#modalApproach">
                                    <data value="{{$period->id}}" id="{{$period->id}}"></data>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            @endforeach

            <div class="card mb-4" id="tools">
                <div class="card-body">
                    <div class="dropbox" role="button" data-bs-toggle="modal" data-bs-target="#modalPeriodTraining">
                    </div>
                </div>
            </div>


        </div>
    </div>


    <!-- Modal modalPeriodTraining  -->
    <div class="modal fade" id="modalPeriodTraining" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Добавить тренировку</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('periodTraining.store', $day->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="FormName" class="form-label">Упражнения</label>
                            <input type="text" name="name" class="form-control" id="FormName" placeholder="Приседания с гантелями">
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

    <!-- Modal modalApproach  -->
    <div class="modal fade" id="modalApproach" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Добавление подхода</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('approach.store', $day->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="period_training_id" id="period_training_id">
                            <label for="ForGram" class="form-label">kg</label>
                            <input type="number" name="kg" class="form-control" id="ForGram" placeholder="0">
                        </div>
                        <div class="mb-3">
                            <label for="ForGram" class="form-label">Павтор</label>
                            <input type="number" name="repeat" class="form-control" id="ForGram" placeholder="0">
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
            document.getElementById('period_training_id').value = element.value;
        }
    </script>


@endsection
