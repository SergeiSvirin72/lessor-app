@foreach($rooms as $room)
    <tr class="flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap lg:mb-0 py-2">
        <td class="w-full lg:w-auto px-3 py-2 lg:px-6 lg:py-4 whitespace-nowrap text-sm block lg:table-cell">
            <p class="lg:hidden text-sm font-medium text-gray-500">Помещение</p>
            <a href="/estates/{{ $estate['id'] }}/rooms/{{ $room['id'] }}"
               class="font-medium text-indigo-600 hover:text-indigo-900">{{ $room['name'] }}</a>
        </td>
        <td class="w-full lg:w-auto px-3 py-2 lg:px-6 lg:py-4 whitespace-nowrap block lg:table-cell">
            <p class="lg:hidden text-sm font-medium text-gray-500">Статус</p>
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
              Active
            </span>
        </td>
        <td class="w-full lg:w-auto px-3 py-2 lg:px-6 lg:py-4 whitespace-nowrap block lg:table-cell">
            <p class="lg:hidden text-sm font-medium text-gray-500">Площадь</p>
            <div class="text-sm text-gray-900">{{ $room['size'] }}</div>
        </td>
        <td class="w-full lg:w-auto px-3 py-2 lg:px-6 lg:py-4 whitespace-nowrap block lg:table-cell">
            <p class="lg:hidden text-sm font-medium text-gray-500">Цена</p>
            <div class="text-sm text-gray-900">{{ $room['price'] }}</div>
        </td>
        <td class="w-full lg:w-auto px-3 py-2 lg:px-6 lg:py-4 whitespace-nowrap block lg:table-cell">
            <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-900 mr-4">Изменить</a>
            <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-900">Удалить</a>
        </td>
    </tr>
@endforeach
