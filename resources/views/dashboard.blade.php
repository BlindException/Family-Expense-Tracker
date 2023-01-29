<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    <section  aria-labelledby="personalHeader">
        <p id="personalHeader">
            {{ ("My Personal Total") }}
        </p>    
        <p>
            {{ ("$".$userSum)}}
        </p>
        <p>
            {{ ("My portion of family expenses $".round($familyPortion,2))}}
        </p>
        <p>
            {{ ("Total Month To Date Expenses $".round($allTotal,2))}}
        </p>
    </section>
    <section aria-labelledby="familyHeader">
        <p id="familyHeader">
            {{ ("Family Totals Month to Date")}}
        </p>
        @php
$i=0;
@endphp
@forelse($families as $family)

<p>
    {{ ($family->name." $".$familyTotals[$i])}}
</p>
@php
$i++;
@endphp
@empty
@endforelse
<p>
    {{ ("All Families Total $".round($familyTotal,2))}}
</p>
    </section>
    
</x-app-layout>
