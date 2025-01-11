

@if($message = Session::get('success'))
    <dir style="padding: 5px; background-color:green; color:white">
        <p>{{ $message }}</p>
    </dir>
@endif


@if($message = Session::get('danger'))
    <dir style="padding: 2px; background-color:red; color:white">
        <p>{{ $message }}</p>
    </dir>
@endif