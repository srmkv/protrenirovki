@component('mail::message')
    # Welcome to the first Newletter
    Dear {{$data}},
    We look forward to communicating more with you. For more information visit our blog.
    @component('mail::button', ['url' => 'https://laraveltuts.com'])
        Blog
    @endcomponent
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
