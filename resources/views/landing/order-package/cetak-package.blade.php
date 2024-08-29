<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Booking Paket Wisata</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff; /* Mengubah background body menjadi putih */
        }

        .container {
            width: 90%; /* Menyesuaikan lebar container */
            margin: 20px auto; /* Memberikan margin atas dan bawah pada container */
            background-color: #fff; /* Background container tetap putih */
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Memberikan shadow pada container */
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .header p {
            font-size: 16px;
            color: #666;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .column {
            flex: 1;
            min-width: 250px; /* Minimal lebar kolom */
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 10px;
        }

        .column h2 {
            margin-top: 0;
            color: #333;
        }

        .column p {
            font-size: 16px;
            color: #555;
            margin: 8px 0;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
        }

        .footer p {
            margin: 5px 0;
            font-size: 14px;
        }


    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bukti Booking Paket Wisata</h1>
            <p>Terima kasih telah memilih layanan kami!</p>
        </div>
        <div class="row">
            <div class="column">
                <h2>Detail Pemesan</h2>
                <p><strong>Kode Booking:</strong> {{ $orderPackage->code_order }}</p>
                <p><strong>Nama:</strong> {{ ucwords($orderPackage->user->name) }}</p>
                <p><strong>Email:</strong> {{ $orderPackage->user->email }}</p>
                <p><strong>Telepon:</strong> {{ $orderPackage->user->phone }}</p>
                <p><strong>Jenis Kelamin:</strong>
                @if ($orderPackage->user->gender == 'male')
                    <span>Laki-laki</span>
                @else
                    <span>Perempuan</span>
                @endif
                </p>
                <p><strong>Alamat:</strong> {{ ucwords($orderPackage->user->address) }}</p>
            </div>
            <div class="column">
                <h2>Detail Booking Paket Wisata</h2>
                <p><strong>Paket Wisata:</strong> {{ ucwords($orderPackage->package->package_name) }}</p>
                <p><strong>Tujuan Wisata:</strong> {{ ucwords($orderPackage->package->tour->name) }}</p>
                <p><strong>Durasi:</strong> {{ ucwords($orderPackage->package->duration)  }} Hari</p>
                <p><strong>Tanggal Keberangkatan:</strong> {{ date('d F Y', strtotime($orderPackage->departure_date)) }}</p>
                <p><strong>Jumlah Paket:</strong> {{ $orderPackage->quantity_package }}</p>
                <p><strong>Nama Hotel:</strong> {{ ucwords($orderPackage->package->room->hotel->name) }}</p>
                <p><strong>Kamar:</strong> {{ ucwords($orderPackage->package->room->room_type) }}</p>
                <p><strong>Fasilitas:</strong> {{ ucwords($orderPackage->package->room->facility) }}</p>
            </div>

            @php
                $priceHotel = $orderPackage->package->price_hotel * $orderPackage->quantity_package;
                $pricePackage = $orderPackage->package->price_package * $orderPackage->quantity_package;
            @endphp

            <div class="column">
                <h2>Detail Pembayaran</h2>
                <p><strong>Harga Paket Wisata:</strong>@currency($priceHotel)</p>
                <p><strong>Harga Hotel:</strong> @currency($pricePackage)</p>
                <p><strong>Total Harga:</strong> @currency($priceHotel + $pricePackage )</p>
            </div>
        </div>
        <div class="footer">
            <p>Jika Anda memiliki pertanyaan, silakan hubungi kami di {{ $setting->phone}} atau email ke {{ $setting->email}}</p>
            <p>Selamat menikmati perjalanan Anda!</p>
        </div>
    </div>
</body>
</html>
