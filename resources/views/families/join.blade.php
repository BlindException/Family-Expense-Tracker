<x-app-layout>
    
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ ("Join Family") }}
    </h2>
    <form method="POST" action="{{ route('familyusers.store') }}">
    @csrf
    <label class = "block font-medium text-sm text-gray-700 dark:text-gray-300" for = "joinFamilyName">
        {{ ("Enter the family name you wish to join") }}
        <input class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="joinFamilyName" name="name" value = "{{ old('name') }}" required/>
    </label>
    <x-input-error :messages="$errors->get('message')" class="mt-2" />
        <label class = "block font-medium text-sm text-gray-700 dark:text-gray-300" for = "joinFamilyPassword">
            {{ ("Enter family password") }}
            <input class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="password" id="joinFamilyPassword" name="password" value = "{{ old('name') }}" required/>
        </label>
        <x-input-error :messages="$errors->get('message')" class="mt-2" />
    <button type = "submit" class="mt-4">{{ ("Save") }}</button>
    </form>
</x-app-layout>