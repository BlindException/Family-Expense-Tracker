<x-app-layout>
    
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ ("New Family") }}
    </h2>
    <form method="POST" action="{{ route('families.store') }}">
    @csrf
    <label class = "block font-medium text-sm text-gray-700 dark:text-gray-300" for = "newFamilyName">
        {{ ("Enter a name for the new family") }}
        <input class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="newFamilyName" name="name" value = "{{ old('name') }}" required/>
    </label>
    <x-input-error :messages="$errors->get('message')" class="mt-2" />
        <label class = "block font-medium text-sm text-gray-700 dark:text-gray-300" for = "newFamilyPassword">
            {{ ("Enter a password for the new family") }}
            <input class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="password" id="newFamilyPassword" name="password" value = "{{ old('name') }}" required/>
        </label>
        <x-input-error :messages="$errors->get('message')" class="mt-2" />
    <button type = "submit" class="mt-4">{{ ("Save") }}</button>
    </form>
</x-app-layout>