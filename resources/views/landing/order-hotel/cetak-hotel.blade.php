<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Hotel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        .ticket {
            background-color: #ffffff;
            width: 100vh;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            padding: 20px;
            box-sizing: border-box;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .logo {
            width: 150px;
            height: 50px;
            background-color: #d0d0d0;
        }

        .section {
            margin-top: 20px;
        }

        .section h2 {
            font-size: 18px;
            margin: 0 0 10px 0;
        }

        .flight-info {
            display: flex;
            justify-content: space-between
        }

        .airline p,
        .details p,
        .booking-code p {
            margin: 5px 0;
        }

        .note {
            margin-top: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }

        .note p {
            margin: 5px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>
    <div class="ticket">
        <div class="header">
            <h1>BOOKING HOTEL</h1>
        </div>
        <div class="section">
            <div class="flight-info">
                <div class="booking-code">
                    <h2>{{ ucwords($orderHotel->name) }}</h2>
                    <p><strong>{{ $orderHotel->created_at->format('l, d F Y') }}</strong></p>
                    <p>Kode Booking: <strong>{{ $orderHotel->code_order }}</strong></p>
                </div>
            </div>
        </div>
        <div class="note">
            <p>Alamat:</p>
            <p>{{ $orderHotel->user->address }}</p>
        </div>
        <div class="section">
            <h2>Detail Pesanan</h2>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hotel</th>
                        <th>Kamar</th>
                        <th>Tgl. Check In</th>
                        <th>Tgl. Check Out</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ ucwords($orderHotel->room->hotel->name) }}</td>
                        <td>{{ ucwords($orderHotel->room->room_type) }}</td>
                        <td>{{ date('d F Y', strtotime($orderHotel->check_in_date)) }}</td>
                        <td>{{ date('d F Y', strtotime($orderHotel->check_out_date)) }}</td>
                        <td>@currency($orderHotel->amount)</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="section" style="margin-bottom: 30px;">
            <h2>Detail Pemesan</h2>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Jenis Kelamin</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ ucwords($orderHotel->user->name) }}</td>
                        <td>{{ $orderHotel->user->email }}</td>
                        <td>{{ $orderHotel->user->phone }}</td>
                        <td>
                            @if ($orderHotel->user->gender == 'male')
                                <span>Laki-laki</span>
                            @else
                                <span>Perempuan</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
