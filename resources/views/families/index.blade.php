<x-app-layout>
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    {{ __('Families') }}
</h2>

<div>
<table>
<tr>
    <th>
        {{ ("Family Name") }}
    </th>
    <th>
        {{ ("Family Creator") }}
    </th>
</tr>
@forelse($families as $family)
<tr>
    <td>
        {{ ($family->name) }}
    </td>
    <td>
        {{ ($family->password) }}
    </td>
    <td>
        
        <x-dropdown>
            <x-slot name="trigger">
                <button aria-label = "{{ ("More options for ".$family->name." family.") }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                    </svg>
                                    </button>
            </x-slot>
            <x-slot name="content">
                @if($family->creator->is(auth()->user()))
                <x-dropdown-link :href="route('families.show', $family)">
                    {{ __('Details') }}
                </x-dropdown-link>
                <x-dropdown-link :href="route('families.edit', $family)">
                    {{ __('Edit') }}
                </x-dropdown-link>
                <form method="POST" action="{{ route('families.destroy', $family) }}">
                    @csrf
                    @method('delete')
                    <x-dropdown-link :href="route('families.destroy', $family)" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Delete') }}
                    </x-dropdown-link>
                </form>
                @endif
                @if($family->users->contains(auth()->user())&&$family->creator!=auth()->user())
                <form method="POST" action="{{ route('familyusers.destroy', ['familyuser'=>auth()->user(),'family' =>$family]) }}">
                    @csrf
                    @method('delete')
                    <x-dropdown-link :href="route('familyusers.destroy', ['familyuser' => auth()->user(), 'family' => $family])" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Leave Family') }}
                    </x-dropdown-link>
                </form>
                @endif
            </x-slot>
        </x-dropdown>
    </td>
    
</tr>
@empty
<tr>
    <td>
        {{ ("You are not a member of any families, ") }}
        <a href = "{{ route('families.create') }}">
        {{ (' create one') }}
    </a>
    </td>
</tr>
@endforelse
</table>
</div>
</x-app-layout>