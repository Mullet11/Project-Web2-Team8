<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Status Booking Ruangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
            color: #334155;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #2563eb;
            color: #ffffff;
            padding: 24px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 32px 24px;
        }
        .content p {
            line-height: 1.6;
            margin-bottom: 16px;
        }
        .details {
            background-color: #f1f5f9;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
        }
        .details table {
            width: 100%;
            border-collapse: collapse;
        }
        .details th {
            text-align: left;
            padding: 8px 0;
            color: #64748b;
            font-weight: normal;
            width: 40%;
        }
        .details td {
            padding: 8px 0;
            font-weight: bold;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 9999px;
            font-weight: bold;
            font-size: 14px;
        }
        .status-menunggu {
            background-color: #fef08a;
            color: #854d0e;
        }
        .status-disetujui {
            background-color: #bbf7d0;
            color: #166534;
        }
        .status-ditolak {
            background-color: #fecaca;
            color: #991b1b;
        }
        .footer {
            background-color: #f8fafc;
            padding: 16px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Smart Class Booking</h1>
        </div>
        <div class="content">
            <p>Halo, <strong>{{ $reservation->user->name ?? $reservation->nama }}</strong>!</p>
            
            @if($statusType === 'menunggu')
                <p>Pengajuan peminjaman ruangan Anda telah berhasil kami terima. Saat ini pengajuan Anda sedang <strong>menunggu persetujuan</strong> dari Administrator. Kami akan memberitahu Anda kembali melalui email jika statusnya telah diperbarui.</p>
            @elseif($statusType === 'disetujui')
                <p>Kabar baik! Pengajuan peminjaman ruangan Anda telah <strong>DISETUJUI</strong> oleh Administrator.</p>
            @elseif($statusType === 'ditolak')
                <p>Mohon maaf, pengajuan peminjaman ruangan Anda telah <strong>DITOLAK</strong> oleh Administrator. Silakan ajukan kembali di waktu atau ruangan yang berbeda jika diperlukan.</p>
            @endif

            <div class="details">
                <table>
                    <tr>
                        <th>Nomor Booking</th>
                        <td>{{ $reservation->no_booking }}</td>
                    </tr>
                    <tr>
                        <th>Ruangan</th>
                        <td>{{ $reservation->room->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>{{ \Carbon\Carbon::parse($reservation->tanggal)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Waktu</th>
                        <td>{{ substr($reservation->waktu_mulai, 0, 5) }} - {{ substr($reservation->waktu_selesai, 0, 5) }}</td>
                    </tr>
                    <tr>
                        <th>Keperluan</th>
                        <td>{{ $reservation->perihal }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="status-badge status-{{ $statusType }}">
                                {{ strtoupper($statusType) }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>

            <p>Terima kasih telah menggunakan layanan Smart Class Booking!</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Smart Class Booking ULM. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
