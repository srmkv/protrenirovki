@extends('admin.layouts.master')

@section('content')

    <!-- BEGIN: Content -->
    <div class="content">
    @include('admin.layouts.navbar')

    @if ($message = Session::get('success'))
        <!-- BEGIN: Notification Content -->
            <div class="toastify on  toastify-right toastify-top" style="transform: translate(0px, 0px); top: 15px;"><div id="success-notification-content" class="toastify-content flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round" icon-name="check-circle" class="lucide lucide-check-circle text-success"
                         data-lucide="check-circle"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01">
                        </polyline>
                    </svg>
                    <div class="ml-4 mr-4">
                        <div class="font-medium">{{ $message }}</div>
                    </div>
                </div>
            </div>
            <!-- END: Notification Content -->
        @endif

        <h2 class="intro-y text-lg font-medium mt-10">
            {{__('messages.exercises')}}
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                    <a href="{{route('exercises.create')}}" class="btn btn-primary shadow-md mr-2">{{__('messages.create')}}</a>
                    <a href="{{route('exercises.export')}}" class="btn btn-primary shadow-md mr-2">{{__('messages.export')}}</a>
            </div>


            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                    <tr>
                        <th class="whitespace-nowrap">{{__('messages.name')}}</th>
                        <th class="whitespace-nowrap">{{__('messages.type')}}</th>
                        <th class="whitespace-nowrap">{{__('messages.type_train')}}</th>
                        <th class="whitespace-nowrap">{{__('messages.inventory')}}</th>
                        <th class="whitespace-nowrap">{{__('messages.experience')}}</th>
                        <th class="whitespace-nowrap">{{__('messages.room')}}</th>
                        <th class="text-center whitespace-nowrap">{{__('messages.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($exercises as $exercise)
                        <tr>
                            <td>
                                {{ $exercise->name }}
                            </td>
                            <td>
                                {{ $exercise->type }}
                            </td>
                            <td>
                                {{ $exercise->type_train }}
                            </td>
                            <td>
                                {{ $exercise->apparatus }}
                            </td>
                            <td>
                                {{ $exercise->experience }}
                            </td>
                            <td>
                                {{ $exercise->room }}
                            </td>
                            <td>

                                <a class="flex items-center text-warning mr-3" href="{{ route('exercise.edit', $exercise->id) }}">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> {{__('messages.edit')}} </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END: Data List -->
            {{ $exercises->links('admin.vendor.pagination.custom')}}
        </div>

    </div>
    <!-- END: Content -->

@endsection
