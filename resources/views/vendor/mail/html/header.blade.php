<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'getThrillsStream')
<img src="{{asset('asset/img/logo.png')}}" class="logo" alt="getThrills Stream">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
