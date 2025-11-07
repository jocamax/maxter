<x-app-layout>

<div class="mx-auto max-w-5xl py-10 px-6">
        <h1 class="text-2xl font-semibold mb-6">Pristigle poruke</h1>

        <table class="min-w-full border border-gray-300 bg-white">
            <thead class="bg-gray-100">
            <tr>
                <th class="border px-3 py-2 text-left">ID</th>
                <th class="border px-3 py-2 text-left">Ime</th>
                <th class="border px-3 py-2 text-left">Firma</th>
                <th class="border px-3 py-2 text-left">Email</th>
                <th class="border px-3 py-2 text-left">Telefon</th>
                <th class="border px-3 py-2 text-left">Poruka</th>
                <th class="border px-3 py-2 text-left">Datum</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($questions as $question)
                <tr class="hover:bg-gray-50">
                    <td class="border px-3 py-2">{{ $question->id }}</td>
                    <td class="border px-3 py-2">{{ $question->name }}</td>
                    <td class="border px-3 py-2">{{ $question->firm ?? '—' }}</td>
                    <td class="border px-3 py-2">{{ $question->email }}</td>
                    <td class="border px-3 py-2">{{ $question->phone ?? '—' }}</td>
                    <td class="border px-3 py-2">{{ $question->message }}</td>
                    <td class="border px-3 py-2">{{ $question->created_at->format('d.m.Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="border px-3 py-4 text-center text-gray-500">
                        Nema pristiglih poruka.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    </x-app-layout>
