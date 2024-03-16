<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/icons/phosphor/styles.min.css') }}">
    <title>Reservasi Camping Private</title>
    <style>
        body {
            font-family: Arial, sans-serif;
			font-size: 18px;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
        }

        .items {
            margin-bottom: 10px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .items>p {
            margin-bottom: 0;
        }

        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }
        }

        .footer {
            background-color: #f2f2f2;
            padding: 15px 20px;
            text-align: center;
            border-top: 1px solid #ccc;
        }

        .footer ul {
            list-style: none;
            padding: 0;
            display: inline-block;
            margin: 0;
        }

        .footer ul li {
            margin: 0 5px;
            padding: 0;
            font-size: 25px;
            line-height: 1.5;
            color: #555;
            transition: color 0.2s;
        }

        .footer ul li a {
            color: #555;
            text-decoration: none;
        }

        .footer ul li:hover {
            color: #333;
        }

        .footer p {
            margin: 0;
            font-size: 14px;
            line-height: 1.5;
            color: #555;
            padding: 0 0 10px;
        }

		table {
		    border-collapse: collapse;
		    width: 100%;
		    margin-top: 20px;
		}

		th, td {
		    border: 1px solid black;
		    padding: 8px;
		    text-align: left;
		}

		th {
		    background-color: #f2f2f2;
		}

		.price {
			text-align: right;
		}

		.pay-button {
			background-color: #007bff;
			padding: 10px 20px;
			color: #fff;
			border: none;
			border-radius: 5px;
			display: block;
			margin: 20px auto;
		}

		.pay-button:hover {
			cursor: pointer;
			background-color: #0069d9;
		}

		.pay-button-text {
			text-transform: uppercase;
			display: block;
			font-size: 14px;
			line-height: 1.5;
			color: #fff;
		}

		.qrcode {
			text-align: center;
		}
    </style>
</head>

<body>
    <div class="container">
        {{-- <img src="{{ asset('assets/images/taman_langit.png') }}" style="display: block; margin: 0 auto;"> --}}
        <img src="https://reservasi.c-ss.co.id/assets/images/taman_langit.png" style="display: block; margin: 0 auto;">
        <h1>Reservasi Camping Private</h1>
        <p>Halo {{ $data['name'] }},</p>
        <p>
			Terima kasih sudah melakukan reservasi di {{ ENV('APP_NAME') }}.
		</p>
        <p>
			Kami sangat senang untuk menyambutmu, semoga ini menjadi petualangan dan pengalaman baru untukmu.
		</p>
        <p>
			Berikut ini adalah rincian dari reservasimu:
		</p>
        <table>
            <tr>
                <th>Item</th>
                <th class="price">Harga</th>
            </tr>
            <tr>
                <td>Paket: {{ ucwords(strtolower($data['wahana']['name'])) }} ({{ $data['night_count'] }} malam)</td>
                <td class="price">{{ number_format($data['price']) }}</td>
            </tr>
            <tr>
                <td>PPN</td>
                <td class="price">{{ $data['ppn'] }}% / {{ number_format($data['ppn_amount']) }}</td>
            </tr>
            <tr>
                <td>Diskon</td>
                <td class="price">{{ ($data['coupon_id'] != null) ? '- '.number_format($data['discount_amount']) : '-' }}</td>
            </tr>
            <tr>
                <td>Total Tagihan</td>
                <td class="price">{{ number_format($data['total_amount']) }}</td>
            </tr>
        </table>

		<button class="pay-button">
			<span class="pay-button-text">Lanjutkan Pembayaran</span>
		</button>

        <div class="footer">
            <p>Ikuti kami di sosial media:</p>
            <ul>
                <li>
                    <a href="https://www.instagram.com/" target="_blank"><i class="ph-instagram-logo"></i></a>
                    <a href="https://www.facebook.com/" target="_blank"><i class="ph-facebook-logo"></i></a>
                    <a href="https://www.youtube.com/" target="_blank"><i class="ph-youtube-logo"></i></a>
                    <a href="https://www.youtube.com/" target="_blank"><i class="ph-tiktok-logo"></i></a>
                </li>
            </ul>
        </div>
</body>
</html>