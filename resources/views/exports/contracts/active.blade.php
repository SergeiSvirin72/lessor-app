<table>
    <thead>
    <tr>
        <th scope="col">Арендатор</th>
        <th scope="col">№ договора</th>
        <th scope="col">Дата заключения</th>
        <th scope="col">Дата окончания</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contracts as $contract)
        <tr>
            <td>{{ $contract['tenant']['short_name'] }}</td>
            <td>{{ $contract['number'] }}</td>
            <td>{{ $contract['date_start'] }}</td>
            <td>{{ $contract['date_end'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>