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

                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2 text-left">
                                        Naam
                                    </th>
                                    <th class="border px-4 py-2 text-left">
                                        Contactpersoon
                                    </th>
                                    <th class="border px-4 py-2 text-left">
                                        Leveranciernummer
                                    </th>
                                    <th class="border px-4 py-2 text-left">
                                        Mobiel
                                    </th>
                                    <th class="border px-4 py-2 text-left">
                                        Aantal verschillende producten
                                    </th>
                                    <th class="border px-4 py-2 text-center">
                                        Acties
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($leveranciers as $leverancier)
                                    <tr>
                                        <td class="border px-4 py-2">
                                            {{ $leverancier['Naam'] }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{ $leverancier['ContactPersoon'] }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{ $leverancier['LeverancierNummer'] }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{ $leverancier['Mobiel'] }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{ $leverancier['AantalVerschillendeProducten'] }}
                                        </td>

                                        <td class="border px-4 py-2 text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg"
     width="22"
     height="22"
     viewBox="0 0 24 24"
     fill="none"
     stroke="currentColor"
     stroke-width="1.7"
     stroke-linecap="round"
     stroke-linejoin="round">
    <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
    <path d="M3 8v9l9 5 9-5V8"/>
    <path d="M12 13v9"/>
</svg>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="flex justify-end mt-6">
    <a href="{{ route('magazijn.index') }}"
       class="bg-gray-700 hover:bg-gray-800 text-white px-6 py-2 rounded">
        Home
    </a>
</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
