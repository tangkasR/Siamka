@foreach ($listBulan as $bulan)
    @foreach ($kehadirans as $data)
        @if ($bulan['i'] == $data->month)
            <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                <td class="p-4">
                    {{ $data->year }}</td>
                <td class="p-4">
                    {{ $bulan['bulan'] }}</td>
                <td class="p-4">
                    {{ $data->hadir }}</td>
                <td class="p-4">
                    {{ $data->sakit }}</td>
                <td class="p-4">
                    {{ $data->izin }}</td>
                <td class="p-4">
                    {{ $data->alpa }}</td>
            </tr>
        @endif
    @endforeach
@endforeach
