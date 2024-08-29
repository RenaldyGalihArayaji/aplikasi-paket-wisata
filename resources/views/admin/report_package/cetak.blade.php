<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Paket Wisata</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            color: #495057;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-heading {
            background-color: #f8f9fa;
            padding: 80px 0;
        }

        .page-heading h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .page-heading p {
            font-size: 1rem;
            margin: 0;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border: 1px solid #dee2e6;
            border-collapse: collapse;
            margin-top: 1.5rem;
        }

        .table th, .table td {
            padding: 0.75rem;
            border: 1px solid #dee2e6;
        }

        th {
            text-align: left;
            color: #495057;
            background-color: #e9ecef;
        }

        h3 {
            font-size: 1.75rem;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            font-weight: bold;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-black {
            color: #000 !important;
        }
    </style>
</head>
<body >
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                @php
                    $setting = DB::table('settings')->where('id',1)->first();
                @endphp
                <h2><strong>{{ ucwords($setting->name_app)}}</strong></h2>
                <h3><strong>Laporan Paket Wisata</strong></h3>
            </div>
        </div>
        <hr style="border-width: 5px;">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Booking</th>
                    <th>Paket Wisata</th>
                    <th>Hotel</th>
                    <th>Kamar</th>
                    <th>Jumlah Paket</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Tanggal Keberangkatan</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @isset($packageData)
                @php
                    $total = 0;
                @endphp
                    @forelse ($packageData as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->code_order }}</td>
                            <td>{{ ucwords($item->package->package_name) }}</td>
                            <td>{{ ucwords($item->package->room->hotel->name) }}</td>
                            <td>{{ ucwords($item->package->room->room_type) }}</td>
                            <td>{{ $item->quantity_package }}</td>
                            <td>{{ date('d F Y', strtotime($item->order_date)) }}</td>
                            <td>{{ date('d F Y', strtotime($item->departure_date)) }}</td>
                            <td>@currency($item->amount)</td>
                        </tr>
                    @php
                        $total += $item->amount;
                    @endphp
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Data Kosong!!</td>
                        </tr>
                    @endforelse
                @endisset
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="font-weight-bold">TOTAL</td>
                    <td colspan="4" class="font-weight-bold">@currency($total)</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <script>
        // Tunggu sampai dokumen selesai dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Mencetak dokumen setelah halaman selesai dimuat
            window.print();
        });
    </script>
</body>
</html>
