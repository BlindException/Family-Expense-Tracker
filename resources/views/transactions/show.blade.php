<x-app-layout>
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    {{ __('Transaction Details') }}
</h2>

<div>
<table>
<tr>
    <th>
        {{ ("Title") }}
    </th>
    <td>
        {{ ($transaction->title) }}
    </td>
</tr>
<tr>
    <th>
        {{ ("Details") }}
    </th>
    <td>
        {{ ($transaction->details) }}
    </td>
</tr>
<tr>
    <th>
        {{ ("Category") }}
    </th>
    <td>
        {{ ($transaction->category->text) }}
    </td>
</tr>
<tr>
    <th>
        {{ ("Amount") }}
    </th>
    <td>
        {{ ($transaction->amount) }}
    </td>
</tr>
<tr>
    <th>
        {{ ("Date Paid") }}
    </th>
    <td>
        @php
        $datetime = new datetime($transaction->paid_at);
        $datetime = date_format($datetime, 'Md, Y');
        @endphp
        {{ ($datetime) }}
    </td>
</tr>
<tr>
    <th>
        {{ ("Paid By") }}
    </th>
    <td>
        {{ ($transaction->creator->name) }}
    </td>
</tr>
<tr>
    <th>
        {{ ("Belongs To") }}
    </th>
    <td>
        {{ ($transaction->owner->name) }}
    </td>
</tr>
<tr>
    <td>
        <a href = "{{ route('transactions.index') }}">
        {{ ('Back to all transactions') }}
    </a>
    </td>
</tr>
</table>
</div>
</x-app-layout>