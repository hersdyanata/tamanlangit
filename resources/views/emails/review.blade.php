<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/icons/phosphor/styles.min.css') }}">
    <title>Review</title>
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

        .cancel-button {
			background-color: #EF4444;
			padding: 10px 20px;
			color: #fff;
			border: none;
			border-radius: 5px;
			display: block;
			margin: 20px auto;
		}

		.cancel-button:hover {
			cursor: pointer;
			background-color: #d31c1c;
		}

		.cancel-button-text {
			text-transform: uppercase;
			display: block;
			font-size: 14px;
			line-height: 1.5;
			color: #fff;
		}

        .cancel-link {
            font-style: italic;
            color: #d31c1c;
        }

    </style>
</head>

<body>
    <div class="container">
        {{-- <img src="{{ asset('assets/images/taman_langit.png') }}" style="display: block; margin: 0 auto;"> --}}
        <img src="https://demo.tamanlangitpangalengan.com/assets/images/taman_langit.png" style="display: block; margin: 0 auto;">
        <h1>Sampai Jumpa Di lain waktu</h1>
        <p>Halo {{ $data['name'] }},</p>
        <p>
			Kami harap kamu mendapatkan pengalaman yang baik selama berkemah di {{ ucwords(strtolower($data['wahana']['name'])) }} {{ env('APP_NAME') }}. Dan mohon maaf untuk kekurangan kami. Saran, masukkan dan review kamu akan sangat berarti sekali untuk kami.
		</p>

        <p>
            Jika berkenan, silahkan bagikan cerita dan pengalaman kamu selama berkemah di {{ env('APP_NAME') }} <a href="{{ route('review', [ $data['wahana']['slug'], Crypt::encryptString($data['id']) ]) }}" target="_blank">disini</a>.
        </p>

        <p>
            Kami akan selalu berusaha untuk terus meningkatkan kualitas pelayanan.
        </p>

        <p>
            Sampai jumpa kembali di lain kesempatan!
        </p>
</body>
</html>