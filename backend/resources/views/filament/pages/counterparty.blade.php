<x-filament-panels::page>

    <style>
        .counterparty-page {
            width: 100%;
            max-width: none !important;
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        .counterparty-search {
            width: 100%;
            box-sizing: border-box;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .counterparty-search__header {
            margin-bottom: 20px;
        }

        .counterparty-search__title {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #111827;
        }

        .counterparty-search__description {
            margin: 6px 0 0;
            font-size: 14px;
            color: #6b7280;
        }

        .counterparty-search__form {
            width: 100%;
            max-width: 520px;
        }

        .counterparty-results-section {
            width: 100%;
        }

        .counterparty-results__header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .counterparty-results__title {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #111827;
        }

        .counterparty-results__count {
            margin: 5px 0 0;
            font-size: 14px;
            color: #6b7280;
        }

        .counterparty-results {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .counterparty-card {
            min-width: 0;
            width: 100%;
            box-sizing: border-box;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition:
                border-color 0.15s ease,
                box-shadow 0.15s ease,
                transform 0.15s ease;
        }

        .counterparty-card:hover {
            border-color: #c7d2fe;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            transform: translateY(-1px);
        }

        .counterparty-card__body {
            padding: 22px;
        }

        .counterparty-card__header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .counterparty-card__name {
            margin: 0;
            font-size: 16px;
            line-height: 1.5;
            font-weight: 600;
            color: #111827;
        }

        .counterparty-card__full-name {
            margin: 4px 0 0;
            font-size: 13px;
            line-height: 1.5;
            color: #6b7280;
        }

        .counterparty-card__status {
            flex-shrink: 0;
            padding: 4px 9px;
            border-radius: 999px;
            background: #ecfdf5;
            color: #047857;
            font-size: 11px;
            line-height: 1.3;
            font-weight: 600;
            text-transform: uppercase;
        }

        .counterparty-card__details {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px 24px;
            margin-top: 22px;
        }

        .counterparty-card__label {
            margin-bottom: 4px;
            font-size: 10px;
            line-height: 1.4;
            font-weight: 600;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .counterparty-card__value {
            font-size: 14px;
            line-height: 1.5;
            font-weight: 500;
            color: #111827;
            word-break: break-word;
        }

        .counterparty-card__address {
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px solid #f3f4f6;
        }

        .counterparty-card__address-value {
            display: flex;
            align-items: flex-start;
            gap: 7px;
            font-size: 13px;
            line-height: 1.6;
            color: #4b5563;
        }

        .counterparty-card__address-icon {
            flex-shrink: 0;
            margin-top: 3px;
            color: #9ca3af;
        }

        .counterparty-card__action {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px solid #f3f4f6;
        }

        @media (max-width: 1200px) {
            .counterparty-results {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 700px) {
            .counterparty-results {
                grid-template-columns: 1fr;
            }

            .counterparty-search {
                padding: 18px;
            }

            .counterparty-card__body {
                padding: 18px;
            }

            .counterparty-card__details {
                grid-template-columns: 1fr;
            }

            .counterparty-card__header {
                flex-direction: column;
            }
        }

        @media (prefers-color-scheme: dark) {
            .counterparty-search,
            .counterparty-card {
                background: #111827;
                border-color: #374151;
            }

            .counterparty-search__title,
            .counterparty-results__title,
            .counterparty-card__name,
            .counterparty-card__value {
                color: #f9fafb;
            }

            .counterparty-search__description,
            .counterparty-results__count,
            .counterparty-card__full-name,
            .counterparty-card__address-value {
                color: #9ca3af;
            }

            .counterparty-card__address,
            .counterparty-card__action {
                border-color: #1f2937;
            }

            .counterparty-card:hover {
                border-color: #4f46e5;
            }
        }
    </style>

    <div class="counterparty-page">

        {{-- Поиск --}}
        <section class="counterparty-search">
            <div class="counterparty-search__header">
                <h2 class="counterparty-search__title">
                    Поиск контрагента
                </h2>

                <p class="counterparty-search__description">
                    Введите ИНН для поиска информации о юридическом лице.
                </p>
            </div>

            <div class="counterparty-search__form">
                {{ $this->form }}
            </div>
        </section>

        {{-- Результаты --}}
        @if ($counterparties)
            <section class="counterparty-results-section">

                <div class="counterparty-results__header">
                    <div>
                        <h2 class="counterparty-results__title">
                            Результаты поиска
                        </h2>

                        <p class="counterparty-results__count">
                            Найдено вариантов: {{ count($counterparties) }}
                        </p>
                    </div>
                </div>

                <div class="counterparty-results">

                    @foreach ($counterparties as $counterparty)
                        <article
                            class="counterparty-card"
                            wire:key="counterparty-{{ $counterparty->inn }}"
                        >
                            <div class="counterparty-card__body">

                                {{-- Название + статус --}}
                                <div class="counterparty-card__header">
                                    <div>
                                        <h3 class="counterparty-card__name">
                                            {{ $counterparty->shortName ?? $counterparty->fullName }}
                                        </h3>

                                        @if ($counterparty->shortName && $counterparty->fullName)
                                            <p class="counterparty-card__full-name">
                                                {{ $counterparty->fullName }}
                                            </p>
                                        @endif
                                    </div>

                                    @if ($counterparty->status)
                                        <span class="counterparty-card__status">
                                            {{ $counterparty->status }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Реквизиты --}}
                                <div class="counterparty-card__details">

                                    <div>
                                        <div class="counterparty-card__label">
                                            ИНН
                                        </div>

                                        <div class="counterparty-card__value">
                                            {{ $counterparty->inn }}
                                        </div>
                                    </div>

                                    @if ($counterparty->ogrn)
                                        <div>
                                            <div class="counterparty-card__label">
                                                ОГРН
                                            </div>

                                            <div class="counterparty-card__value">
                                                {{ $counterparty->ogrn }}
                                            </div>
                                        </div>
                                    @endif

                                    @if ($counterparty->kpp)
                                        <div>
                                            <div class="counterparty-card__label">
                                                КПП
                                            </div>

                                            <div class="counterparty-card__value">
                                                {{ $counterparty->kpp }}
                                            </div>
                                        </div>
                                    @endif

                                    @if ($counterparty->okvedMainCode)
                                        <div>
                                            <div class="counterparty-card__label">
                                                ОКВЭД
                                            </div>

                                            <div class="counterparty-card__value">
                                                {{ $counterparty->okvedMainCode }}
                                            </div>
                                        </div>
                                    @endif

                                </div>

                                {{-- Адрес --}}
                                @if ($counterparty->address)
                                    <div class="counterparty-card__address">

                                        <div class="counterparty-card__label">
                                            Адрес
                                        </div>

                                        <div class="counterparty-card__address-value">
                                            <span class="counterparty-card__address-icon">
                                                ●
                                            </span>

                                            <span>
                                                {{ $counterparty->address }}
                                            </span>
                                        </div>

                                    </div>
                                @endif

                                {{-- Кнопка --}}
                                <div class="counterparty-card__action">
                                    <x-filament::button
                                        wire:click="selectCounterparty({{ $loop->index }})"
                                    >
                                        Выбрать
                                    </x-filament::button>
                                </div>

                            </div>
                        </article>
                    @endforeach

                </div>

            </section>
        @endif

    </div>

</x-filament-panels::page>
