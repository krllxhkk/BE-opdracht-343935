
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Geleverde producten
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-8">

                <div class="mb-6">
                    <p class="text-lg font-semibold">
                        Naam leverancier: {{ $leverancier['Naam'] }}
                    </p>

                    <p class="mt-3">
                        Contactpersoon: {{ $leverancier['ContactPersoon'] }}
                    </p>

                    <p class="mt-3">
                        Leverancier NR: {{ $leverancier['LeverancierNummer'] }}
                    </p>

                    <p class="mt-3">
                        Mobiel: {{ $leverancier['Mobiel'] }}
                    </p>
                </div>

                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-3">Naam product</th>
                            <th class="border border-gray-300 px-4 py-3">Aantal in magazijn</th>
                            <th class="border border-gray-300 px-4 py-3">Verpakkingseenheid</th>
                            <th class="border border-gray-300 px-4 py-3">Laatste levering</th>
                            <th class="border border-gray-300 px-4 py-3">Nieuwe levering</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td colspan="5"
                                class="border border-gray-300 px-4 py-4 text-center">
                                Dit bedrijf heeft tot nu toe geen producten geleverd aan Jamin
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="flex justify-end gap-4 mt-6">
    <a href="{{ route('leveranciers.index') }}"
       class="inline-flex items-center justify-center min-w-[110px] px-6 py-3 bg-gray-700 text-white rounded whitespace-nowrap">
        Terug
    </a>

    <a href="{{ route('magazijn.index') }}"
       class="inline-flex items-center justify-center min-w-[110px] px-6 py-3 bg-gray-700 text-white rounded whitespace-nowrap">
        Home
    </a>
</div>

            </div>
        </div>
    </div>

    <script>
        setTimeout(function () {
            window.location.href = "{{ route('leveranciers.index') }}";
        }, 3000);
    </script>
</x-app-layout>
