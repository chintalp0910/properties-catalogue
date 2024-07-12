<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('assets/front/images/dark-logo.png') }}" width="100%" height="80px"  alt="Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
