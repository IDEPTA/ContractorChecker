<?php

namespace App\Contractors\Application\DTO;

use DateTimeImmutable;
use Livewire\Wireable;

final class CounterpartyDto implements Wireable
{
    public function __construct(
        public readonly string $inn,
        public readonly ?string $ogrn,
        public readonly ?string $kpp,
        public readonly ?string $fullName,
        public readonly ?string $shortName,
        public readonly ?string $status,
        public readonly ?DateTimeImmutable $registrationDate,
        public readonly ?DateTimeImmutable $liquidationDate,
        public readonly ?string $address,
        public readonly ?string $okvedMainCode,
        public readonly ?string $okvedMainName,
        public readonly ?int $employeesCount,
        public readonly array $founders = [],
        public readonly array $managers = [],
        public readonly array $okveds = [],
        public readonly array $phones = [],
        public readonly array $emails = [],
        public readonly array $websites = [],
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            inn: $data['inn'] ?? '',
            ogrn: $data['ogrn'] ?? null,
            kpp: $data['kpp'] ?? null,
            fullName: $data['name']['full_with_opf'] ?? null,
            shortName: $data['name']['short_with_opf'] ?? null,
            status: $data['state']['status'] ?? null,
            registrationDate: isset($data['state']['registration_date'])
                ? self::timestampToDate($data['state']['registration_date'])
                : null,
            liquidationDate: isset($data['state']['liquidation_date'])
                ? self::timestampToDate($data['state']['liquidation_date'])
                : null,
            address: $data['address']['value'] ?? null,
            okvedMainCode: $data['okved'] ?? null,
            okvedMainName: null,
            employeesCount: $data['employee_count'] ?? null,
            founders: $data['founders'] ?? [],
            managers: $data['managers'] ?? [],
            okveds: $data['okveds'] ?? [],
            phones: $data['phones'] ?? [],
            emails: $data['emails'] ?? [],
            websites: $data['sites'] ?? [],
        );
    }

    public function toLivewire(): array
    {
        return [
            'inn' => $this->inn,
            'ogrn' => $this->ogrn,
            'kpp' => $this->kpp,
            'fullName' => $this->fullName,
            'shortName' => $this->shortName,
            'status' => $this->status,
            'registrationDate' => $this->registrationDate?->format('Y-m-d H:i:s'),
            'liquidationDate' => $this->liquidationDate?->format('Y-m-d H:i:s'),
            'address' => $this->address,
            'okvedMainCode' => $this->okvedMainCode,
            'okvedMainName' => $this->okvedMainName,
            'employeesCount' => $this->employeesCount,
            'founders' => $this->founders,
            'managers' => $this->managers,
            'okveds' => $this->okveds,
            'phones' => $this->phones,
            'emails' => $this->emails,
            'websites' => $this->websites,
        ];
    }

    public static function fromLivewire($value): self
    {
        return new self(
            inn: $value['inn'],
            ogrn: $value['ogrn'] ?? null,
            kpp: $value['kpp'] ?? null,
            fullName: $value['fullName'] ?? null,
            shortName: $value['shortName'] ?? null,
            status: $value['status'] ?? null,
            registrationDate: isset($value['registrationDate'])
                ? new DateTimeImmutable($value['registrationDate'])
                : null,
            liquidationDate: isset($value['liquidationDate'])
                ? new DateTimeImmutable($value['liquidationDate'])
                : null,
            address: $value['address'] ?? null,
            okvedMainCode: $value['okvedMainCode'] ?? null,
            okvedMainName: $value['okvedMainName'] ?? null,
            employeesCount: $value['employeesCount'] ?? null,
            founders: $value['founders'] ?? [],
            managers: $value['managers'] ?? [],
            okveds: $value['okveds'] ?? [],
            phones: $value['phones'] ?? [],
            emails: $value['emails'] ?? [],
            websites: $value['websites'] ?? [],
        );
    }

    private static function timestampToDate(int $timestamp): DateTimeImmutable
    {
        return (new DateTimeImmutable())
            ->setTimestamp((int) ($timestamp / 1000));
    }
}
