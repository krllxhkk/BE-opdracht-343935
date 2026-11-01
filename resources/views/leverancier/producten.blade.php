<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Geleverde producten
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Gegevens van de leverancier --}}
<div class="mb-6 space-y-2">
    <h3 class="text-lg font-semibold">
        Naam leverancier: {{ $leverancier['Naam'] }}
    </h3>

    <p>
        Contactpersoon: {{ $leverancier['ContactPersoon'] }}
    </p>

    <p>
        Leverancier NR: {{ $leverancier['LeverancierNummer'] }}
    </p>

    <p>
        Mobiel: {{ $leverancier['Mobiel'] }}
    </p>
</div>

                    {{-- Overzicht van geleverde producten --}}
                    <div class="overflow-x-auto">
                       {{-- Overzicht van geleverde producten --}}
<div class="overflow-x-auto">
    <table class="min-w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2 text-left">
                    Naam product
                </th>
                <th class="border px-4 py-2 text-left">
                    Aantal in magazijn
                </th>
                <th class="border px-4 py-2 text-left">
                    Verpakkingseenheid
                </th>
                <th class="border px-4 py-2 text-left">
                    Laatste levering
                </th>
                <th class="border px-4 py-2 text-center">
                    Nieuwe levering
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($producten as $product)
                <tr>
                    <td class="border px-4 py-2">
                        {{ $product['NaamProduct'] }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $product['AantalInMagazijn'] }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $product['VerpakkingsEenheid'] }} kg
                    </td>

                    <td class="border px-4 py-2">
                        {{ $product['DatumLaatsteLevering']
                            ? \Carbon\Carbon::parse($product['DatumLaatsteLevering'])->format('d-m-Y')
                            : '-' }}
                    </td>

                    <td class="border px-4 py-2 text-center">
                        <a href="{{ route('leverancier.levering.create', [
        'leverancierId' => $leverancier['Id'],
        'productId' => $product['ProductId']
    ]) }}"
   class="text-green-600 hover:text-green-800 text-2xl font-bold"
   title="Nieuwe levering">
    +
</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
                    </div>

                    {{-- Navigatieknoppen --}}
<div class="flex justify-end gap-3 mt-6">
    <a href="{{ route('leveranciers.index') }}"
       class="bg-gray-700 hover:bg-gray-800 text-white px-6 py-2 rounded">
        Terug
    </a>

    <a href="{{ route('magazijn.index') }}"
       class="bg-gray-700 hover:bg-gray-800 text-white px-6 py-2 rounded">
        Home
    </a>
</div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>