<div class="column is-3">
    <aside class="is-medium menu">
        <p class="menu-label">
            СПТ 941
        </p>
        @php
            $categories = [
                '/' => [
                    'text' => 'Установить соединение',
                ],
                'devices' => [
                    'text' => 'Сохраненные устройства',
                ]
            ];
        @endphp
        <ul class="menu-list">
            @foreach ($categories as $link => $category)
                <li>
                    <a href="{{ url($link) }}" 
                        class="{{ Request::is($link) ? 'is-active' : null }}">
                        {{ $category['text'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </aside>
</div>