@props(['link', 'tahun', 'semester'])
@if ($semester == 'ganjil')
    <a href="{{ route($link, ['tahun' => $tahun, 'semester' => $semester]) }}"
        class="cursor-pointer w-full hover:text-white text-blue-600 font-medium  hover:bg-blue-600 border-2 border-blue-600 btn capitalize transition-all duration-300">
        Semester {{ $semester }}
    </a>
@endif
@if ($semester == 'genap')
    <a href="{{ route($link, ['tahun' => $tahun, 'semester' => $semester]) }}"
        class="cursor-pointer w-full hover:text-white text-blue-600 font-medium  hover:bg-blue-600 border-2 border-blue-600 btn capitalize transition-all duration-300">
        Semester {{ $semester }}
    </a>
@endif
