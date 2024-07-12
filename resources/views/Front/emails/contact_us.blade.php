@component('mail::message')
    <h2>
        Hello {{ $data['firstname'] . ' ' . $data['lastname'] }},</h2>
    <p><b>Email:</b> {{ $data['email'] }}</p>
    <p><b>Number:</b> {{ $data['number'] }}</p>
    <p><b>Subject:</b> {{ $data['subject'] }}</p>
    <p><b>Message:</b> {{ $data['message'] }}</p>

    Thanks You,
@endcomponent
