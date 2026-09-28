<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">

    <style>
        @page {
            margin: 35px 40px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1f2937;
            font-size: 11px;
            line-height: 1.5;
        }

        h1, h2, h3, p {
            margin: 0;
        }

        .header {
            border-bottom: 2px solid #111827;
            padding-bottom: 18px;
            margin-bottom: 25px;
        }

        .header-title {
            font-size: 24px;
            font-weight: bold;
            color: #111827;
        }

        .header-subtitle {
            margin-top: 5px;
            color: #6b7280;
            font-size: 10px;
        }

        .section {
            margin-bottom: 24px;
        }

        .section-title {
            font-size: 15px;
            font-weight: bold;
            color: #111827;
            padding-bottom: 7px;
            border-bottom: 1px solid #d1d5db;
            margin-bottom: 12px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 7px 9px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        .info-table td:first-child {
            width: 35%;
            color: #6b7280;
        }

        .info-table td:last-child {
            font-weight: bold;
            color: #111827;
        }

        .status {
            display: inline-block;
            padding: 3px 8px;
            background: #dcfce7;
            color: #166534;
            font-weight: bold;
        }

        .status.inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty {
            color: #9ca3af;
            font-style: italic;
        }

        .list {
            width: 100%;
            border-collapse: collapse;
        }

        .list th {
            text-align: left;
            background: #f3f4f6;
            padding: 8px;
            font-weight: bold;
            border-bottom: 1px solid #d1d5db;
        }

        .list td {
            padding: 8px;
            border-bottom: 1px solid #e5e7eb;
        }

        .footer {
            position: fixed;
            bottom: -20px;
            left: 0;
            right: 0;
            text-align: center;
            color: #9ca3af;
            font-size: 9px;
        }

        .grid {
            width: 100%;
            border-collapse: separate;
            border-spacing: 8px;
            margin: -8px;
        }

        .card {
            border: 1px solid #e5e7eb;
            padding: 12px;
        }

        .card-title {
            color: #6b7280;
            font-size: 9px;
            text-transform: uppercase;
        }

        .card-value {
            margin-top: 3px;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="header">
    <div class="header-title">Отчёт о контрагенте</div>
    <div class="header-subtitle">
        Сформирован {{ now()->format('d.m.Y H:i') }}
    </div>
</div>

<div class="section">
    <div class="section-title">Основная информация</div>

    <table class="grid">
        <tr>
            <td class="card">
                <div class="card-title">ИНН</div>
                <div class="card-value">{{ $data['inn'] ?? '—' }}</div>
            </td>

            <td class="card">
                <div class="card-title">ОГРН</div>
                <div class="card-value">{{ $data['ogrn'] ?? '—' }}</div>
            </td>

            <td class="card">
                <div class="card-title">КПП</div>
                <div class="card-value">{{ $data['kpp'] ?? '—' }}</div>
            </td>
        </tr>
    </table>

    <table class="info-table">
        <tr>
            <td>Полное наименование</td>
            <td>{{ $data['full_name'] ?? '—' }}</td>
        </tr>

        <tr>
            <td>Краткое наименование</td>
            <td>{{ $data['short_name'] ?? '—' }}</td>
        </tr>

        <tr>
            <td>Статус</td>
            <td>
                @if(($data['status'] ?? null) === 'ACTIVE')
                    <span class="status">Действующая</span>
                @else
                    <span class="status inactive">
                        {{ $data['status'] ?? 'Неизвестен' }}
                    </span>
                @endif
            </td>
        </tr>

        <tr>
            <td>Дата регистрации</td>
            <td>
                {{ !empty($data['registration_date'])
                    ? \Carbon\Carbon::parse($data['registration_date'])->format('d.m.Y')
                    : '—'
                }}
            </td>
        </tr>

        <tr>
            <td>Дата ликвидации</td>
            <td>
                {{ !empty($data['liquidation_date'])
                    ? \Carbon\Carbon::parse($data['liquidation_date'])->format('d.m.Y')
                    : '—'
                }}
            </td>
        </tr>

        <tr>
            <td>Адрес</td>
            <td>{{ $data['address'] ?? '—' }}</td>
        </tr>
    </table>
</div>

<div class="section">
    <div class="section-title">Виды деятельности</div>

    <table class="info-table">
        <tr>
            <td>Основной ОКВЭД</td>
            <td>
                @if(!empty($data['okved_main_code']))
                    {{ $data['okved_main_code'] }}
                    — {{ $data['okved_main_name'] }}
                @else
                    <span class="empty">Не указан</span>
                @endif
            </td>
        </tr>

        <tr>
            <td>Количество сотрудников</td>
            <td>{{ $data['employees_count'] ?? '—' }}</td>
        </tr>
    </table>

    @if(!empty($data['okveds']))
        <table class="list">
            <thead>
            <tr>
                <th>Код</th>
                <th>Наименование</th>
            </tr>
            </thead>

            <tbody>
            @foreach($data['okveds'] as $okved)
                <tr>
                    <td>{{ $okved['code'] ?? '—' }}</td>
                    <td>{{ $okved['name'] ?? '—' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>

@if(!empty($data['founders']))
    <div class="section">
        <div class="section-title">Учредители</div>

        <table class="list">
            <thead>
            <tr>
                <th>Наименование</th>
                <th>Доля</th>
            </tr>
            </thead>

            <tbody>
            @foreach($data['founders'] as $founder)
                <tr>
                    <td>{{ $founder['name'] ?? '—' }}</td>
                    <td>{{ $founder['share'] ?? '—' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif

@if(!empty($data['managers']))
    <div class="section">
        <div class="section-title">Руководители</div>

        <table class="list">
            <thead>
            <tr>
                <th>ФИО</th>
                <th>Должность</th>
            </tr>
            </thead>

            <tbody>
            @foreach($data['managers'] as $manager)
                <tr>
                    <td>{{ $manager['name'] ?? '—' }}</td>
                    <td>{{ $manager['position'] ?? '—' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif

@if(!empty($data['phones']) || !empty($data['emails']) || !empty($data['websites']))
    <div class="section">
        <div class="section-title">Контактная информация</div>

        <table class="info-table">
            @if(!empty($data['phones']))
                <tr>
                    <td>Телефоны</td>
                    <td>{{ implode(', ', $data['phones']) }}</td>
                </tr>
            @endif

            @if(!empty($data['emails']))
                <tr>
                    <td>Email</td>
                    <td>{{ implode(', ', $data['emails']) }}</td>
                </tr>
            @endif

            @if(!empty($data['websites']))
                <tr>
                    <td>Сайты</td>
                    <td>{{ implode(', ', $data['websites']) }}</td>
                </tr>
            @endif
        </table>
    </div>
@endif

<div class="footer">
    ContractorChecker · Отчёт сформирован автоматически
</div>

</body>
</html>
