<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        td,
        th {
            font-size: 11px;
        }
    </style>
    <title>TES - Venturo Camp Tahap 2</title>
</head>

<body>
    <div class="container-fluid">
        <div class="card" style="margin: 2rem 0rem;">
            <div class="card-header">
                Venturo - Laporan penjualan tahunan per menu
            </div>
            <div class="card-body">
                <form action="" method="get">
                    <div class="row">
                        <form action="" method="post">
                            @csrf
                            <div class="col-2">
                                <div class="form-group">

                                    <select id="my-select" class="form-control" name="tahun">
                                        <option value="" @selected($tahun == null)>Pilih Tahun</option>
                                        <option value="2021" @selected($tahun == 2021)>2021</option>
                                        <option value="2022" @selected($tahun == 2022)>2022</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary">
                                    Tampilkan
                                </button>
                                @if ($tahun != null)
                                    <a href="http://tes-web.landa.id/intermediate/menu" target="_blank" rel="Array Menu"
                                        class="btn btn-secondary">
                                        Json Menu
                                    </a>
                                    <a href="http://tes-web.landa.id/intermediate/transaksi?tahun={{ $tahun }}"
                                        target="_blank" rel="Array Transaksi" class="btn btn-secondary">
                                        Json Transaksi
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </form>
                <hr>
                @if ($tahun != null)

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" style="margin: 0;">
                            <thead>
                                <tr class="table-dark">
                                    <th rowspan="2" style="text-align:center;vertical-align: middle;width: 250px;">
                                        Menu
                                    </th>
                                    <th colspan="12" style="text-align: center;">Periode Pada {{ $tahun }}
                                    </th>
                                    <th rowspan="2" style="text-align:center;vertical-align: middle;width:75px">Total
                                    </th>
                                </tr>
                                <tr class="table-dark">
                                    <th style="text-align: center;width: 75px;">Jan</th>
                                    <th style="text-align: center;width: 75px;">Feb</th>
                                    <th style="text-align: center;width: 75px;">Mar</th>
                                    <th style="text-align: center;width: 75px;">Apr</th>
                                    <th style="text-align: center;width: 75px;">Mei</th>
                                    <th style="text-align: center;width: 75px;">Jun</th>
                                    <th style="text-align: center;width: 75px;">Jul</th>
                                    <th style="text-align: center;width: 75px;">Ags</th>
                                    <th style="text-align: center;width: 75px;">Sep</th>
                                    <th style="text-align: center;width: 75px;">Okt</th>
                                    <th style="text-align: center;width: 75px;">Nov</th>
                                    <th style="text-align: center;width: 75px;">Des</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="table-secondary" colspan="14"><b>Makanan</b></td>
                                </tr>
                                @foreach ($menu as $m)
                                    @if ($m['kategori'] == 'makanan')
                                        <tr>
                                            <td>{{ $m['menu'] }}</td>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <td>
                                                    @if (isset($totalPerMenu[$i][$m['menu']]))
                                                        {{-- Corrected variable name here --}}
                                                        {{ number_format($totalPerMenu[$i][$m['menu']]) }}
                                                    @endif
                                                </td>
                                            @endfor
                                            <td><b>
                                                    {{ number_format(array_sum(array_column($totalPerMenu, $m['menu']))) }}
                                                </b></td>
                                        </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <td class="table-secondary" colspan="14"><b>Minuman</b></td>
                                </tr>
                                @foreach ($menu as $m)
                                    @if ($m['kategori'] == 'minuman')
                                        <tr>
                                            <td>{{ $m['menu'] }}</td>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <td>
                                                    @if (isset($totalPerMenu[$i][$m['menu']]))
                                                        {{-- Corrected variable name here --}}
                                                        {{ number_format($totalPerMenu[$i][$m['menu']]) }}
                                                    @endif
                                                </td>
                                            @endfor
                                            <td><b>
                                                    {{ number_format(array_sum(array_column($totalPerMenu, $m['menu']))) }}
                                                </b></td>
                                        </tr>
                                    @endif
                                @endforeach
                                <tr class="table-dark">
                                    <td><b>Total</b></td>
                                    @php
                                        $grandTotal = 0;
                                    @endphp
                                    @for ($i = 1; $i <= 12; $i++)
                                        <td>
                                            @if (isset($totalPerBulan[$i]))
                                                {{ number_format($totalPerBulan[$i]) }}
                                                @php
                                                    $grandTotal += $totalPerBulan[$i];
                                                @endphp
                                            @else
                                            @endif
                                        </td>
                                    @endfor
                                    <td><b>{{ number_format($grandTotal) }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>


</body>

</html>
