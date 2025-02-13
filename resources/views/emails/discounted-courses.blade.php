@component('mail::message')
    # Discounted Courses

    On {{ config('app.name') }}, we're offering discounts on the following courses:

    @foreach ($discountedCourses as $course)
        ** {{ $course->title }} - {{ $course->discount }}% off
    @endforeach

    You can find more details about these courses at {{ config('app.url') }}

    @component('mail::button', ['url' => url('login')])
        Login
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
