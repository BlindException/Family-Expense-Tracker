<x-app-layout>
    
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ ("New Transaction") }}
    </h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="{{ route('transactions.store') }}">
    @csrf
    <label class = "block font-medium text-sm text-gray-700 dark:text-gray-300" for = "newTransactionTitle">
        {{ ("Enter or select a title for the new transaction ") }}
        <input class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="newTransactionTitle" name="title" value = "{{ old('title') }}" list="transactionTitles" required/>
        <datalist id="transactionTitles">
            @forelse($transactionTitles as $title)
            <option value = "{{ ($title->title) }}"></option>
            @empty
            @endforelse
        </datalist>
    </label>
    <x-input-error :messages="$errors->get('message')" class="mt-2" />
        <label class = "block font-medium text-sm text-gray-700 dark:text-gray-300" for = "newTransactionDetails">
            {{ ("Enter the details for the new transaction ") }}
            <input class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="newTransactionDetails" name="details" value = "{{ old('details') }}"" />
        </label>
        <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <label class = "block font-medium text-sm text-gray-700 dark:text-gray-300" for = "newTransactionType">
                {{ ("Select a transaction type") }}
                <select class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="newTransactionType" name="transaction_type_id" value = "{{ old('transaction_type_id') }}" required>
                    <option value = ""selected>Select a Type</option>
                    @forelse ($transactionTypes as $type)
                        <option value = "{{ ($type->id) }}">
                            {{ ($type->text) }}
                        </option>
                    @empty
                        
                    @endforelse
                </select>
            </label>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                <label class = "block font-medium text-sm text-gray-700 dark:text-gray-300" for = "newTransactionCategory">
                    {{ ("Select a transaction Category") }}
                    <select class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="newTransactionCategory" name="transaction_category_id" value = "{{ old('transaction_category_id') }}" required>
                        <option value = ""selected>Select a Category</option>
                        @forelse($transactionCategories as $transactionCategory)
                        <option value = "{{ ($transactionCategory->id) }}">
                            {{ ($transactionCategory->text) }}
                        </option>
                        @empty
                        @endforelse
                    </select>
                </label>
                <span>Don't see the category you need? <a href = "{{ route('transactioncategories.create') }}">
                {{ ("Create the one you need.") }}
            </a>
        </span>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                <label class = "block font-medium text-sm text-gray-700 dark:text-gray-300" for = "newTransactionAmount">
                    {{ ("Enter the amount for the new transaction") }}
                                        <input type="number" class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="newTransactionAmount" name="amount" value = "{{ old('amount') }}" min="{{ (.01)}}" step = ".01" required/>
                </label>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    <label class = "block font-medium text-sm text-gray-700 dark:text-gray-300" for = "newTransactionPaidAt">
                        {{ ("Enter when the new transaction was paid") }}
                        <input class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="newTransactionPaidAt" name="paid_at" value = "{{ old('paid_at', now()) }}" required/>
                    </label>
                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                   <fieldset>
                    <legend>
                        {{ ("Whose transaction is this?") }}
                    </legend>
                    <label class = "block font-medium text-sm text-gray-700 dark:text-gray-300" for = "meCb">
                        <input class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="meCb" name="owner_type" value = "{{ ("App\Models\User") }}" type="radio" onchange="setOwner()"  required>
                        {{ ("Me") }}
                    </label>
                    <label class = "block font-medium text-sm text-gray-700 dark:text-gray-300" for = "familyCb">
                        <input class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="familyCb" name="owner_type" value = "{{ ("App\Models\Family") }}" type="radio" onchange="setOwner()" required>
                        {{ ("Family") }}
                    </label>
                </fieldset>                                 

                            <label class = "block font-medium text-sm text-gray-700 dark:text-gray-300" for = "newBelongsTo">
                                {{ ("Select the family the transaction belongs to") }}
                                <select class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="newBelongsTo" disabled >
                                    <option value = ""selected>Select a Family</option>
                                                                                                                @forelse($myFamilies as $family)
                                    <option value = "{{ ($family->id) }}">
                                        {{ ($family->name) }}
                                    </option>
                                    @empty
                                    @endforelse
                                </select>
                            </label>
                            <x-input-error :messages="$errors->get('message')" class="mt-2" /><
                                
                                                                    <input id="owner" name="owner_id" type="text" hidden >
                                                                    
               <input  type = "hidden" value = "{{ (auth()->user()->id) }}" name = "creator_id">
    <button type = "submit" class="mt-4">{{ ("Save") }}</button>
    </form>
    
    <script>
        let id = '';
        let familyID = '';
        let owner = $('#owner');
        let meCb = $('#meCb');
        let familyCb = $('#familyCb');
        let familySL = $('#newBelongsTo');
        
                        function setOwner()
        
        {
                        
                        let userID = <?php echo(auth()->user()->id); ?>;
if(meCb.is(':checked')==true)
{
        familySL.val('');
    familySL.prop('disabled', true);
    familySL.prop('required', false);
    id = userID;
    owner.val(id);
console.log(owner.val());
    }else if (familyCb.is(':checked')==true){
    familySL.prop('disabled', false);
    familySL.prop('required', true);
    familySL.focus();
    familySL.on('change',function(){
familyID = familySL.val();
id = familyID;
owner.val(id);
console.log(owner.val());
            });
                }


        }
       </script>
</x-app-layout>