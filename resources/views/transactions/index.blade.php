<x-app-layout>
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    {{ __('Transactions') }}
</h2>

<div>
<table>
<tr>
    <th>
        {{ ("Title") }}
    </th>
    <th>
        {{ ("Amount") }}
    </th>
    <th>
        {{ ("Paid At") }}
    </th>
    <th>
        {{ ("Belongs To") }}
    </th>
</tr>
@forelse($transactions as $transaction)
<tr>
    <td>
        {{ ($transaction->title) }}
    </td>
            <td>
            {{ ($transaction->amount) }}
        </td>
        <td>
            {{ ($transaction->paid_at) }}
        </td>
        <td>
            {{ ($transaction->owner->name) }}
        </td>
        <td>
        @if($transaction->owner->is(auth()->user())||auth()->user()->families->contains($transaction->owner))
        <x-dropdown>
            <x-slot name="trigger">
                <button aria-label= "{{ ("More options for ".$transaction->title) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                    </svg>
                                    </button>
            </x-slot>
            <x-slot name="content">
                <x-dropdown-link :href="route('transactions.show', $transaction)">
                    {{ __('Details') }}
                </x-dropdown-link>
                <x-dropdown-link :href="route('transactions.edit', $transaction)">
                    {{ __('Edit') }}
                </x-dropdown-link>
                <form method="POST" action="{{ route('transactions.destroy', $transaction) }}">
                    @csrf
                    @method('delete')
                    <x-dropdown-link :href="route('transactions.destroy', $transaction)" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Delete') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </td>
    @endif
</tr>
@empty
<tr>
    <td>
        {{ ("No Transactions") }}
    </td>
</tr>
@endforelse
</table>
</div>
</x-app-layout>