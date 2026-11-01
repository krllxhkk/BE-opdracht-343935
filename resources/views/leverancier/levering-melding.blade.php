<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Levering product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <p class="text-red-600 text-lg font-semibold text-center">
                    Het product {{ $product->Naam }} van de leverancier
                    {{ $leverancier['Naam'] }} wordt niet meer geproduceerd
                </p>

            </div>
        </div>
    </div>

    {{-- Ga na 4 seconden terug naar de geleverde producten --}}
    <script>
        setTimeout(function () {
            window.location.href = "{{ route('leverancier.producten', $leverancier['Id']) }}";
        }, 4000);
    </script>
</x-app-layout>