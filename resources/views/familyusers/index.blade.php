<x-app-layout>
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    {{ __('Manage Family Members') }}
</h2>

<div>
<table>
<tr>
    <th>
        {{ ("Member Name") }}
    </th>
    <th>
        {{ ("Member Email") }}
    </th>
</tr>
@forelse($familyUsers as $familyuser)
<tr>
    <td>
        {{ ($familyuser->name) }}
    </td>
    <td>
        {{ ($familyuser->email) }}
    </td>
    <td>
        @if($family->creator->is(auth()->user())&&$familyUsers->contains(auth()->user())&&!$familyuser->is(auth()->user()))
        <x-dropdown>
            <x-slot name="trigger">
                <button aria-label = "{{ ("More options for member ".$familyuser->name.".") }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                    </svg>
                                    </button>
            </x-slot>
            <x-slot name="content">
                <form method="POST" action="{{ route('familyusers.destroy', [$familyuser, 'family' =>$family]) }}">
                    @csrf
                    @method('delete')
                    <x-dropdown-link :href="route('families.destroy', [$familyuser, 'family' => $family])" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Remove from family') }}
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
        {{ ("There are no members for this family") }}
        </td>
</tr>
@endforelse
</table>
</div>
</x-app-layout>