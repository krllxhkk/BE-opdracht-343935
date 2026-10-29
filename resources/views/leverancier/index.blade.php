```blade
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Overzicht leveranciers
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2 text-left">Naam</th>
                                <th class="border px-4 py-2 text-left">
                                    Aantal verschillende producten
                                </th>
                                <th class="border px-4 py-2 text-left">Acties</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($leveranciers as $leverancier)
                                <tr>
                                    <td class="border px-4 py-2">
                                        {{ $leverancier['Naam'] }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        {{ $leverancier['AantalVerschillendeProducten'] }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        <button
                                            type="button"
                                            class="bg-blue-500 text-white px-3 py-1 rounded"
                                            disabled
                                            title="Wordt in de volgende stap toegevoegd"
                                        >
                                            ▣ Toon producten
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
```