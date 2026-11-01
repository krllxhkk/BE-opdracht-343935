<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Levering Product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Gegevens van het product en de leverancier --}}
                    <div class="mb-8 space-y-2">
                        <p>
                            Product: {{ $product->Naam }}
                        </p>

                        <p>
                            Leverancier: {{ $leverancier['Naam'] }}
                        </p>

                        <p>
                            Contactpersoon: {{ $leverancier['ContactPersoon'] }}
                        </p>

                        <p>
                            Mobiel: {{ $leverancier['Mobiel'] }}
                        </p>
                    </div>

                    {{-- Formulier voor een nieuwe levering --}}
                    <form action="{{ route('leverancier.levering.store', [
    'leverancierId' => $leverancier['Id'],
    'productId' => $product->Id
]) }}" method="POST">

    @csrf
                        <div class="mb-4">
                            <label for="aantal" class="block mb-2">
                                Aantal producteenheden
                            </label>

                            <input
                                type="number"
                                id="aantal"
                                name="aantal"
                                min="1"
                                required
                                class="border-gray-300 rounded-md shadow-sm w-full"
                            >
                        </div>

                        <div class="mb-6">
                            <label for="datum" class="block mb-2">
                                Datum eerstvolgende levering
                            </label>

                            <input
                                type="date"
                                required
                                id="datum"
                                name="datum"
                                class="border-gray-300 rounded-md shadow-sm w-full"
                            >
                        </div>

                        {{-- Navigatieknoppen --}}
                        <div class="flex justify-between items-center">
                            <button
    type="submit"
    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded"
>
    Sla op
</button>

                            <div class="flex gap-3">
                                <a href="{{ route('leverancier.producten', $leverancier['Id']) }}"
                                   class="bg-gray-700 hover:bg-gray-800 text-white px-6 py-2 rounded">
                                    Terug
                                </a>

                                <a href="{{ route('magazijn.index') }}"
                                   class="bg-gray-700 hover:bg-gray-800 text-white px-6 py-2 rounded">
                                    Home
                                </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>