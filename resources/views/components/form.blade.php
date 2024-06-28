@props(['data'])
<form id="form_{{ $data->id }}" action="#" method="POST">
    @csrf
    {{ $slot }}
</form>
