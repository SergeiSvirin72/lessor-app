<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }
        table {
            border-collapse: collapse;
        }
        td {
            border: 1px solid black;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        .clear {
            clear: both;
        }
    </style>
</head>
<body>
    <div style="text-align: center">
        <h1>АКТ СВЕРКИ</h1>
        <p>
            взаимных расчетов по состоянию с {{ $date_start->format('d.m.Y') }} по {{ $date_end->format('d.m.Y') }}
            <br>
            между {{ $team['document_full_name'] }} и {{ $tenant['document_full_name'] }}
        </p>
    </div>
    <div>
        <p>
                Мы, нижеподписавшиеся, {{ $team['document_short_name'] }}, с одной стороны, и {{ $tenant['document_short_name'] }}, с другой стороны, составили настоящий акт сверки в том, что состояние взаимный расчетов по данным учета следующее:
        </p>
    </div>

    <table style="table-layout: fixed; width: 100%;">
        <tr style="text-align: center">
            <td colspan="4" style="width: 50%">По данным {{ $team['document_full_name'] }}</td>
            <td colspan="4" style="width: 50%">По данным {{ $tenant['document_full_name'] }}</td>
        </tr>
        <tr style="text-align: center">
            <td style="width: 5%">№<br>п/п</td>
            <td style="width: 25%">Наименование операции<br>документы</td>
            <td style="width: 10%">Дебет</td>
            <td style="width: 10%">Кредит</td>
            <td style="width: 5%">№<br>п/п</td>
            <td style="width: 25%">Наименование операции<br>документы</td>
            <td style="width: 10%">Дебет</td>
            <td style="width: 10%">Кредит</td>
        </tr>
        @php $i = 1; $bill_amount = 0; $act_amount = 0; @endphp
        @foreach($bills as $bill)
            @php $bill_amount += $bill['amount'] @endphp
            <tr>
                <td>{{ $i++ }}</td>
                <td>Платежное поручение № {{ $bill['number'] }} от {{ $bill['created_at']->format('d.m.Y') }}</td>
                <td></td>
                <td>{{ number_format($bill['amount'], 2, ',', ' ') }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @if(isset($bill['act']))
                @php $act_amount += $bill['act']['amount'] @endphp
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>Акт выполненных работ № {{ $bill['act']['id'] }} от {{ $bill['act']['created_at']->format('d.m.Y') }}</td>
                    <td>{{ number_format($bill['act']['amount'], 2, ',', ' ') }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endif
        @endforeach
        <tr>
            <td>{{ $i++ }}</td>
            <td>Обороты за период</td>
            <td>{{ number_format($act_amount, 2, ',', ' ') }}</td>
            <td>{{ number_format($bill_amount, 2, ',', ' ') }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <div>
        <div style="width: 49%; float: left;">
            По данным {{ $team['document_full_name'] }} с {{ $date_start->format('d.m.Y') }} по {{ $date_end->format('d.m.Y') }}
            задолженность в пользу {{ $team['document_full_name'] }} 0,00 руб.
        </div>
    </div>

    <br class="clear">

    <div>
        <div style="width: 45%; float: left;">
            От {{ $team['document_full_name'] }}
        </div>
        <div style="width: 45%; float: right;">
            От {{ $tenant['document_full_name'] }}
        </div>
    </div>

    <br class="clear">

    <div>
        <div style="width: 45%; float: left; border-bottom: 1px solid black; text-align: right;">
            {{ $team['document_signature'] }}
        </div>
        <div style="width: 45%; float: right; border-bottom: 1px solid black; text-align: right; color: white;">
            {{ $team['document_signature'] }}
        </div>
    </div>

    <br class="clear">

    <div>
        <div style="width: 45%; float: left; text-align: center;">
            М.П.
        </div>
        <div style="width: 45%; float: right; text-align: center;">
            М.П.
        </div>
    </div>
</body>
</html>