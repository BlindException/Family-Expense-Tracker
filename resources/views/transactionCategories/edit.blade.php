<x-app-layout>
  
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ ("Edit a Transaction Category") }}
    </h2>
    <form method="POST" action="{{ route('transactioncategories.update', $transactioncategory) }}">
    @csrf
    @method('patch')
    <label class = "block font-medium text-sm text-gray-700 dark:text-gray-300" for = "editTransactionCategoryText">
        {{ ("Edit the transaction category") }}
        <input class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="editTransactionCategoryText" name="text" value = "{{ old('text', $transactioncategory->text) }}" required/>
    </label>
    <x-input-error :messages="$errors->get('message')" class="mt-2" />
    <button type = "submit" class="mt-4">{{ ("Save Changes") }}</button>
    </form>
</x-app-layout>