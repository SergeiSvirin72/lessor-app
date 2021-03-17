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
    <div style="text-align: center; margin-bottom: 20px">
        ВНИМАНИЕ! Оплата данного счета означает согласие с условиями предоставления услуг.
        При оплате счета, в назначении платежа, ОБЯЗАТЕЛЬНО укажите номер счета.
    </div>
    <table class="requisites" style="width: 100%">
        <tr>
            <td colspan="2" style="border-right: 1px solid black">
                {{ $bill['requisite']['name'] }}
            </td>
            <td style="border-right: 1px solid black;
                border-bottom: 1px solid black;">
                БИК
            </td>
            <td>
                {{ $bill['requisite']['bik'] }}
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="border-right: 1px solid black"></td>
            <td style="border-right: 1px solid black">
                Сч. №
            </td>
            <td>
                {{ $bill['requisite']['account'] }}
            </td>
        </tr>
        <tr>
            <td colspan="2" style="border-right: 1px solid black;
                border-bottom: 1px solid black;
                font-size: 10px;">
                Банк получателя
            </td>
            <td style="border-right: 1px solid black;
                border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
        </tr>
        <tr>
            <td style="border-right: 1px solid black;
                border-bottom: 1px solid black;">
                ИНН {{ $bill['tenant']['inn'] }}
            </td>
            <td style="border-right: 1px solid black;
                border-bottom: 1px solid black;">
                КПП {{ $bill['tenant']['kpp'] }}
            </td>
            <td style="border-right: 1px solid black">
                Сч. №
            </td>
            <td>
                {{ $bill['requisite']['account'] }}
            </td>
        </tr>
        <tr>
            <td colspan="2" style="border-right: 1px solid black">
                {{ $bill['tenant']['full_name'] }} {{ $bill['tenant']['address'] }}
            </td>
            <td style="border-right: 1px solid black"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="border-right: 1px solid black;
                color: white">
                Получатель
            </td>
            <td style="border-right: 1px solid black"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="border-right: 1px solid black;
                font-size: 10px;">
                Получатель
            </td>
            <td style="border-right: 1px solid black"></td>
            <td></td>
        </tr>
    </table>
    <h2>
        Счет на оплату № {{ $bill['number'] }} от {{ Jenssegers\Date\Date::parse($bill['created_at'])->format('d F Y') }}
    </h2>
    <hr style="background-color: black; margin-bottom: 10px">
    <table class="info">
        <tr>
            <td>Поставщик:</td>
            <td>{{ $bill['tenant']['team']['name'] }}</td>
        </tr>
        <tr>
            <td>Покупатель:</td>
            <td>
                {{ $bill['tenant']['full_name'] }},
                ИНН {{ $bill['tenant']['inn'] }},
                {{ $bill['tenant']['address'] }}
            </td>
        </tr>
        <tr>
            <td>Примечание:</td>
            <td>
                ДОГОВОР №{{ $bill['contract']['number'] }}
                ОТ {{ Carbon\Carbon::parse($bill['contract']['date_start'])->format('d.m.Y') }}Г.
            </td>
        </tr>
    </table>

    <table class="services" style="width: 100%">
        <tr class="border">
            <th style="border-top: 2px solid black;
                border-left: 2px solid black;">№</th>
            <th style="border-top: 2px solid black;">Товары (работы, услуги)</th>
            <th style="border-top: 2px solid black;">Кол-во</th>
            <th style="border-top: 2px solid black;">Ед. изм.</th>
            <th style="border-top: 2px solid black;">Цена</th>
            <th style="border-top: 2px solid black;
                border-right: 2px solid black;">Сумма</th>
        </tr>
        @foreach($bill['services'] as $service)
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
                {{ number_format($bill['amount'], 2, ',', ' ') }}
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
            Всего наименований {{ count($bill['services']) }}, на сумму {{ number_format($bill['amount'], 2, ',', ' ') }} руб.
        </span>
        @php
            $str = App\Services\NumberConverter::num2str($bill['amount']);
            $fc = mb_strtoupper(mb_substr($str, 0, 1));
            $amount = $fc.mb_substr($str, 1);
        @endphp
        <br><span style="font-weight: bold;">{{ $amount }}. Без НДС.</span>
        <hr>
    </div>
    <div>
        <div style="width: 40%; float: left;">
            <div style="border-bottom: 1px solid white; float: left;">
                Руководитель
            </div>
            <div style="border-bottom: 1px solid black; color: white;">
                Руководитель
            </div>
        </div>
        <div style="width: 40%; float: right;">
            <div style="border-bottom: 1px solid white; float: left;">
                Бухгалтер
            </div>
            <div style="border-bottom: 1px solid black; color: white;">
                Бухгалтер
            </div>
        </div>
    </div>
</div>
</body>
</html>