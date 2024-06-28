<table class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100">
    <thead>
        <tr class="bg-blue-200">
            <th class="p-4 ">
                Nama Siswa</th>
            <th class="p-4 ">
                Kehadiran</th>
            <th class="p-4 ">
                Tanggal</th>
            <th class="p-4 ">
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kehadirans as $data)
            <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                <td class="p-4">
                    {{ $data->nama }}</td>
                <td class="p-4 ${text_color}">
                    {{ $data->kehadiran }}</td>
                <td class="p-4">
                    {{ $data->tanggal }}</td>
                <td class="p-4">
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
