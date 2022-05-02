<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" class="logo" alt="{{ get_setting('site_name') }} Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
