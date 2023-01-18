<x-app-layout>
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    {{ __($family->name.' Details') }}
</h2>

<div>
<table>
<tr>
    <th>
        {{ ("Family Creator") }}
    </th>
    <td>
        {{ ($family->creator->name) }}
    </td>
</tr>
<tr>
    <th>
        {{ ("Number of Members") }}
    </th>
    <td>
        @php
            $count = count($family->users);
        @endphp
        {{ ($count) }}
    </td>
</tr>
<tr>
    <td>
        <a href = "{{ route('families.index') }}">
{{ ('Back to Families') }}
        </a>
    </td>
</tr>
</table>
</div>
</x-app-layout>