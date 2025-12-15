<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>

    <table>
        <tr>
            <td colspan="6" style="font-weight: bold; font-size: 14px; height: 30px; vertical-align: middle;">
                REKAPITULASI NILAI KELAS PAI</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Kelas PAI</td>
            <td colspan="10" style="text-align: left;">: {{ $classPai->class_name }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Dosen</td>
            <td colspan="10" style="text-align: left;">: {{ $classPai->lecturer }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Fakultas</td>
            <td colspan="10" style="text-align: left;">: {{ $facultyList }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Prodi</td>
            <td colspan="10" style="text-align: left;">: {{ $prodiList }}</td>
        </tr>
        <tr>
            <td></td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th colspan="21"
                    style="font-weight: bold; background-color: #f2f2f2; text-align: center; border: 1px solid #000000; height: 30px; vertical-align: middle;">
                    TABEL AKUMULASI NILAI</th>
            </tr>
            <tr>
                <th rowspan="2"
                    style="font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000; background-color: #92d050;">
                    No
                </th>
                <th rowspan="2"
                    style="font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000; background-color: #92d050;">
                    NIM</th>
                <th rowspan="2"
                    style="font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000; background-color: #92d050;">
                    Nama</th>
                <th rowspan="2"
                    style="font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000; background-color: #92d050;">
                    Asal Halaqah</th>

                <th colspan="5"
                    style="font-weight: bold; text-align: center; background-color: #dbeafe; border: 1px solid #000000; background-color: #34a853;">
                    Pre-Test</th>
                <th colspan="6"
                    style="font-weight: bold; text-align: center; background-color: #dcfce7; border: 1px solid #000000; background-color: #34a853;">
                    Pekanan</th>
                <th colspan="5"
                    style="font-weight: bold; text-align: center; background-color: #e0e7ff; border: 1px solid #000000; background-color: #34a853;">
                    Post-Test</th>
                <th rowspan="2"
                    style="font-weight: bold; text-align: center; vertical-align: middle; background-color: #92d050; border: 1px solid #000000;">
                    Final Test</th>
            </tr>
            <tr>
                <th
                    style="font-weight: bold; background-color: #34a853; border: 1px solid #000000; text-align: center;">
                    K</th>
                <th
                    style="font-weight: bold; background-color: #34a853; border: 1px solid #000000; text-align: center;">
                    HB</th>
                <th
                    style="font-weight: bold; background-color: #34a853; border: 1px solid #000000; text-align: center;">
                    MH</th>
                <th
                    style="font-weight: bold; background-color: #34a853; border: 1px solid #000000; text-align: center;">
                    Total</th>
                <th
                    style="font-weight: bold; background-color: #34a853; border: 1px solid #000000; text-align: center;">
                    Ket</th>

                <th
                    style="font-weight: bold; background-color: #34a853; border: 1px solid #000000; text-align: center;">
                    I</th>
                <th
                    style="font-weight: bold; background-color: #34a853; border: 1px solid #000000; text-align: center;">
                    II</th>
                <th
                    style="font-weight: bold; background-color: #34a853; border: 1px solid #000000; text-align: center;">
                    III</th>
                <th
                    style="font-weight: bold; background-color: #34a853; border: 1px solid #000000; text-align: center;">
                    IV</th>
                <th
                    style="font-weight: bold; background-color: #34a853; border: 1px solid #000000; text-align: center;">
                    V</th>
                <th
                    style="font-weight: bold; background-color: #34a853; border: 1px solid #000000; text-align: center;">
                    VI</th>

                <th
                    style="font-weight: bold; background-color: #34a853; border: 1px solid #000000; text-align: center;">
                    K</th>
                <th
                    style="font-weight: bold; background-color: #34a853; border: 1px solid #000000; text-align: center;">
                    HB</th>
                <th
                    style="font-weight: bold; background-color: #34a853; border: 1px solid #000000; text-align: center;">
                    MH</th>
                <th
                    style="font-weight: bold; background-color: #34a853; border: 1px solid #000000; text-align: center;">
                    Total</th>
                <th
                    style="font-weight: bold; background-color: #34a853; border: 1px solid #000000; text-align: center;">
                    Ket</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($praktikans as $index => $p)
                <tr>
                    <td style="text-align: center; border: 1px solid #000000;">{{ $index + 1 }}</td>
                    <td style="text-align: left; border: 1px solid #000000;">{{ $p->nim }}</td>
                    <td style="border: 1px solid #000000;">{{ $p->nama }}</td>
                    <td style="border: 1px solid #000000;">{{ $p->halaqahs->first()->halaqah_name ?? '-' }}</td>

                    <td style="text-align: center; border: 1px solid #000000;">{{ $p->pre_kbq }}</td>
                    <td style="text-align: center; border: 1px solid #000000;">{{ $p->pre_hb }}</td>
                    <td style="text-align: center; border: 1px solid #000000;">{{ $p->pre_mh }}</td>
                    <td
                        style="text-align: center; font-weight: bold; background-color: #dbeafe; border: 1px solid #000000;">
                        {{ $p->pre_hasil }}</td>
                    <td style="text-align: center; font-size: 9px; border: 1px solid #000000;">{{ $p->pre_ket }}</td>

                    <td style="text-align: center; border: 1px solid #000000;">{{ $p->score1 }}</td>
                    <td style="text-align: center; border: 1px solid #000000;">{{ $p->score2 }}</td>
                    <td style="text-align: center; border: 1px solid #000000;">{{ $p->score3 }}</td>
                    <td style="text-align: center; border: 1px solid #000000;">{{ $p->score4 }}</td>
                    <td style="text-align: center; border: 1px solid #000000;">{{ $p->score5 }}</td>
                    <td style="text-align: center; border: 1px solid #000000;">{{ $p->score6 }}</td>

                    <td style="text-align: center; border: 1px solid #000000;">{{ $p->post_kbq }}</td>
                    <td style="text-align: center; border: 1px solid #000000;">{{ $p->post_hb }}</td>
                    <td style="text-align: center; border: 1px solid #000000;">{{ $p->post_mh }}</td>
                    <td
                        style="text-align: center; font-weight: bold; background-color: #e0e7ff; border: 1px solid #000000;">
                        {{ $p->post_hasil }}</td>
                    <td style="text-align: center; font-size: 9px; border: 1px solid #000000;">{{ $p->post_ket }}</td>

                    <td
                        style="text-align: center; font-weight: bold; background-color: #f3f4f6; border: 1px solid #000000;">
                        {{ $p->final_score }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <table>
        <thead>
            <tr>
                <th colspan="18"
                    style="font-weight: bold; background-color: #f2f2f2; text-align: center; border: 1px solid #000000; height: 30px; vertical-align: middle;">
                    LAPORAN KELULUSAN AKHIR</th>
            </tr>
            <tr>
                <th rowspan="2"
                    style="font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000; background-color: #92d050;">
                    No
                </th>
                <th rowspan="2"
                    style="font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000; background-color: #92d050;">
                    NIM</th>
                <th rowspan="2"
                    style="font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000; background-color: #92d050;">
                    Nama</th>
                <th rowspan="2"
                    style="font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000; background-color: #92d050;">
                    Asal Halaqah</th>

                <th colspan="3"
                    style="font-weight: bold; text-align: center; border: 1px solid #000000; background-color: #34a853;">
                    Pembagian Persentase
                </th>

                <th rowspan="2"
                    style="font-weight: bold; text-align: center; vertical-align: middle; background-color: #34a853; border: 1px solid #000000;">
                    Total (100%)</th>

                <th colspan="4"
                    style="font-weight: bold; text-align: center; border: 1px solid #000000; background-color: #34a853;">
                    Keterangan
                    KBQ</th>

                <th colspan="3" rowspan="2"
                    style="font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000; background-color: #92d050;">
                    Ket. Kehadiran</th>

                <th colspan="3" rowspan="2"
                    style="font-weight: bold; text-align: center; vertical-align: middle; background-color: #92d050; border: 1px solid #000000; background-color: #92d050;">
                    Ket. Lulus</th>
            </tr>
            <tr>
                <th
                    style="font-weight: bold; text-align: center; border: 1px solid #000000; background-color: #34a853;">
                    KBQ (30%)</th>
                <th
                    style="font-weight: bold; text-align: center; border: 1px solid #000000; background-color: #34a853;">
                    Absen (50%)</th>
                <th
                    style="font-weight: bold; text-align: center; border: 1px solid #000000; background-color: #34a853;">
                    Final (20%)</th>

                <th
                    style="font-weight: bold; text-align: center; border: 1px solid #000000; background-color: #34a853;">
                    Pretest</th>
                <th colspan="3"
                    style="font-weight: bold; text-align: center; border: 1px solid #000000; background-color: #34a853;">
                    Posttest</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($praktikans as $index => $p)
                <tr>
                    <td style="text-align: center; border: 1px solid #000000;">{{ $index + 1 }}</td>
                    <td style="text-align: left; border: 1px solid #000000;">{{ $p->nim }} '</td>
                    <td style="border: 1px solid #000000;">{{ $p->nama }}</td>
                    <td style="border: 1px solid #000000;">{{ $p->halaqahs->first()->halaqah_name ?? '-' }}</td>

                    <td style="text-align: center; border: 1px solid #000000;">{{ number_format($p->val_kbq_30, 2) }}
                    </td>
                    <td style="text-align: center; border: 1px solid #000000;">
                        {{ number_format($p->val_absen_50, 2) }}</td>
                    <td style="text-align: center; border: 1px solid #000000;">
                        {{ number_format($p->val_final_20, 2) }}</td>

                    <td
                        style="text-align: center; font-weight: bold; background-color: #e0e7ff; border: 1px solid #000000;">
                        {{ number_format($p->val_total, 2) }}</td>

                    <td style="text-align: center; font-size: 9px; border: 1px solid #000000;">{{ $p->pre_ket }}
                    </td>

                    <td colspan="3" style="text-align: center; font-size: 9px; border: 1px solid #000000;">
                        {{ $p->post_ket }}</td>

                    <td colspan="3"
                        style="text-align: center; font-weight: bold; color: {{ $p->ket_absen == 'AKTIF' ? '#166534' : '#991b1b' }}; border: 1px solid #000000;">
                        {{ $p->ket_absen }}
                    </td>

                    <td colspan="3"
                        style="text-align: center; font-weight: bold; color: {{ $p->ket_lulus == 'LULUS' ? '#166534' : '#991b1b' }}; border: 1px solid #000000;">
                        {{ $p->ket_lulus }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <table>
        <tr>
            <td colspan="4" style="font-weight: bold; font-size: 14px;">DATA STATISTIK</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th colspan="2" style="font-weight: bold; background-color: #f2f2f2; border: 1px solid #000000;">
                    Kategori</th>
                <th colspan="2"
                    style="font-weight: bold; background-color: #dbeafe; border: 1px solid #000000; text-align: center;">
                    Pre-Test</th>
                <th colspan="2"
                    style="font-weight: bold; background-color: #e0e7ff; border: 1px solid #000000; text-align: center;">
                    Post-Test</th>
                <th colspan="2"
                    style="font-weight: bold; background-color: #f2f2f2; border: 1px solid #000000; text-align: center;">
                    Delta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $cat)
                @php
                    $preCount = $statsPre[$cat];
                    $postCount = $statsPost[$cat];
                    $delta = $postCount - $preCount;
                @endphp
                <tr>
                    <td colspan="2" style="border: 1px solid #000000;">{{ $cat }}</td>
                    <td colspan="2" style="text-align: center; border: 1px solid #000000;">{{ $preCount }}
                    </td>
                    <td colspan="2" style="text-align: center; border: 1px solid #000000;">{{ $postCount }}
                    </td>
                    <td colspan="2"
                        style="text-align: center; border: 1px solid #000000; color: {{ $delta > 0 ? 'green' : 'red' }}">
                        {{ $delta > 0 ? '+' . $delta : $delta }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
