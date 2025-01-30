@use('Illuminate\Support\Facades\Vite')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 20px;
        }

        .section-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            letter-spacing: -0.5px;
            width: 90%;
        }

        .table-container {
            overflow-x: auto;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            width: 90%;
        }
        
        *{
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th {
            text-align: center;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            color: black;
            background-color: #f9fafb;
            letter-spacing: 0.05em;
        }

        td {
            white-space: nowrap;
            font-size: 10px;
            color: #374151;
            text-align:center;
        }

        tr {
            border-bottom: 1px solid #e5e7eb;
        }

        tbody tr:hover {
            background-color: #f9fafb;
            transition: background-color 0.2s;
        }
    </style>
</head>
<body>
    <!-- Your existing table structure remains the same, just remove the Tailwind classes -->
    <div class="section-container">
        <p class="section-title">Laporan Pesanan Masuk</p>
        <div class="table-container">
            <table border="1">
                <thead>
                    <tr>
                        @foreach($PesananMasukKeys as $pesananKeys)
                        <th scope="col">
                            {{ str_replace("_"," ",$pesananKeys) }}    
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forEach($PesananMasuk as $pesanan)
                    <tr>
                        @foreach($PesananMasukKeys as $pesananKeys)
                            <td>
                                {{ $pesanan[$pesananKeys] }}
                            </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="section-container">
        <p class="section-title">Laporan Bunga Masuk</p>
        <div class="table-container">
            <table border="1">
                <thead>
                    <tr>
                        @foreach($BungaMasukKeys as $bungaMasukKeys)
                        <th scope="col">
                            {{ str_replace("_"," ",$bungaMasukKeys) }}    
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody >
                    @forEach($BungaMasuk as $bungaMasuk)
                    <tr >
                        @foreach($BungaMasukKeys as $bungaMasukKeys)
                            <td >
                                
                            {{ $bungaMasuk[$bungaMasukKeys] }}
                            </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
</body>
</html>

