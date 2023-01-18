<x-app-layout>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transaction Categories') }}
        </h2>

<div>
    <table>
        <tr>
            <th>
                {{ ("Transaction Category Title") }}
            </th>
        </tr>
        @forelse($transactionCategories as $transactionCategory)
        <tr>
            <td>
                {{ ($transactionCategory->text) }}
            </td>
            <td>
                @if(auth()->user())
                <x-dropdown>
                    <x-slot name="trigger">
                        <button title = "{{ ("More options for ".$transactionCategory->text) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                                                    </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('transactioncategories.edit', $transactionCategory)">
                            {{ __('Edit') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('transactioncategories.destroy', $transactionCategory) }}">
                            @csrf
                            @method('delete')
                            <x-dropdown-link :href="route('transactioncategories.destroy', $transactionCategory)" onclick="event.preventDefault(); this.closest('form').submit();">
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
                {{ ("No Transaction Categories") }}
            </td>
        </tr>
        @endforelse
    </table>
</div>
</x-app-layout>