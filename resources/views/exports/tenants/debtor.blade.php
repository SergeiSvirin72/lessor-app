<table>
    <thead>
    <tr>
        <th scope="col">Арендатор</th>
        <th scope="col">ИНН</th>
        <th scope="col">Количество помещений</th>
        <th scope="col">Депозит (руб.)</th>
        <th scope="col">Долг (руб.)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tenants as $tenant)
        <tr>
            <td>{{ $tenant['short_name'] }}</td>
            <td>{{ $tenant['inn'] }}</td>
            <td>{{ $tenant['contract_rooms_count'] }}</td>
            <td>{{ $tenant['balance'] }}</td>
            <td>{{ $tenant['debt'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>