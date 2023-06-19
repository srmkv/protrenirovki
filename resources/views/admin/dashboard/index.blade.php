@extends('admin.layouts.master')

@section('content')

    <!-- BEGIN: Content -->
    <div class="content">
        @include('admin.layouts.navbar')
        <div class="border w-1/4 p-3">
            <h4 class="header">Парсер</h4>
            <div>
                @if($parse_history)
                    @if($parse_history->status === "IN_PROGRESS")
                        Парсинг блюд...
                    @else
                        <p>Последнее обновление: {{ $parse_history->updated_at->diffForHumans() }}</p>
                        <p>Статус: {{ $parse_history->status }}</p>
                    @endif
                @endif
                <form action="{{ route('parse.dishes') }}" method="POST">
                    @csrf
                    <button class="btn btn-primary mt-2">Обновить блюда</button>
                </form>
            </div>
        </div>
    </div>
    <!-- END: Content -->
@endsection
