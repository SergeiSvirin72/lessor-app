<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        .info td:last-child {
            font-weight: bold;
        }
        .info td {
            padding-bottom: 6px;
        }
        .services, .requisites {
            border-collapse: collapse;
        }
        .requisites {
            border: 1px solid black;
        }
        .services .border td, .services .border th {
            border: 1px solid black;
        }
        /*.services {*/
        /*border: 2px solid black;*/
        /*}*/
        .requisites td {
            vertical-align: text-top;
        }
        .services tr:first-child th {
            padding: 7px;
        }
        .services td:nth-child(1),
        .services td:nth-child(3),
        .services td:nth-child(5),
        .services td:nth-child(6) {
            text-align: right;
        }
        .services td:nth-child(2),
        .services td:nth-child(4) {
            text-transform: uppercase;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <h2>
        Акт № {{ $act['id'] }} от {{ Jenssegers\Date\Date::parse($act['created_at'])->format('d F Y') }}
    </h2>
    <hr style="background-color: black; margin-bottom: 10px">
    <table class="info">
        <tr>
            <td>Исполнитель:</td>
            <td>{{ $act['bill']['tenant']['team']['document_full_name'] }}</td>
        </tr>
        <tr>
            <td>Заказчик:</td>
            <td>
                {{ $act['bill']['tenant']['document_full_name'] }}
            </td>
        </tr>
        <tr>
            <td>Основание:</td>
            <td>
                Договор аренды №{{ $act['bill']['contract']['number'] }}
                ОТ {{ Carbon\Carbon::parse($act['bill']['contract']['date_start'])->format('d.m.Y') }}Г.
            </td>
        </tr>
    </table>

    <table class="services" style="width: 100%">
        <tr class="border">
            <th style="border-top: 2px solid black;
                border-left: 2px solid black;">№</th>
            <th style="border-top: 2px solid black;">Наименование работ, услуг</th>
            <th style="border-top: 2px solid black;">Кол-во</th>
            <th style="border-top: 2px solid black;">Ед.</th>
            <th style="border-top: 2px solid black;">Цена</th>
            <th style="border-top: 2px solid black;
                border-right: 2px solid black;">Сумма</th>
        </tr>
        @foreach($act['bill']['services'] as $service)
            <tr class="border">
                <td style="border-left: 2px solid black;">{{ $loop->iteration }}</td>
                <td>{{ $service->name }}</td>
                <td>{{ $service->quantity }}</td>
                <td>{{ $service->measure }}</td>
                <td>{{ number_format($service->price, 2, ',', ' ') }}</td>
                <td style="border-right: 2px solid black;">{{ number_format($service->amount, 2, ',', ' ') }}</td>
            </tr>
        @endforeach
        <tr>
            <td style="border-top: 2px solid black;"></td>
            <td style="border-top: 2px solid black;"></td>
            <td style="border-top: 2px solid black;"></td>
            <td style="border-top: 2px solid black;"></td>
            <td style="border-top: 2px solid black; font-weight: bold">
                Итого:
            </td>
            <td style="border-top: 2px solid black; font-weight: bold">
                {{ number_format($act['amount'], 2, ',', ' ') }}
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-weight: bold">Без налога (НДС)</td>
            <td style="font-weight: bold"></td>
        </tr>
    </table>
    <div>
        <span>
            Всего оказано услуг {{ count($act['bill']['services']) }}, на сумму {{ number_format($act['amount'], 2, ',', ' ') }} руб.
        </span>
        @php
            $str = App\Services\NumberConverter::num2str($act['amount']);
            $fc = mb_strtoupper(mb_substr($str, 0, 1));
            $amount = $fc.mb_substr($str, 1);
        @endphp
        <br><span style="font-weight: bold;">{{ $amount }}. Без НДС.</span>
        <br><br><span>
            Вышеперечисленные услуги выполнены полностью и в срок. Заказчик претензий по объему, качеству и срокам оказания услуг не имеет.
        </span>
        <hr>
    </div>
    <div>
        <div style="width: 45%; float: left;">
            <h3 style="margin-bottom: 4px">
                ИСПОЛНИТЕЛЬ
            </h3>
            <div style="margin-bottom: 8px">
                {{ $act['bill']['tenant']['team']['document_short_name'] }}
            </div>
            <div style="text-align: center">
                <div style="border-bottom: 1px solid black; color: white;">
                    ИСПОЛНИТЕЛЬ
                </div>
                <div>{{ $act['bill']['tenant']['team']['document_signature'] }}</div>
            </div>
        </div>
        <div style="width: 45%; float: right;">
            <h3 style="margin-bottom: 4px">
                ЗАКАЗЧИК
            </h3>
            <div style="margin-bottom: 8px">
                {{ $act['bill']['tenant']['document_short_name'] }}
            </div>
            <div style="border-bottom: 1px solid black; color: white;">
                ЗАКАЗЧИК
            </div>
        </div>
    </div>
</div>
</body>
</html>