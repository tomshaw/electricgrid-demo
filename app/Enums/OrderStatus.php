<?php

namespace App\Enums;

use ValueError;

enum OrderStatus: int
{
    case STATUS_NEW = 0;
    case STATUS_APPROVED = 1;
    case STATUS_COMPLETED = 2;
    case STATUS_CANCELLED = 3;
    case STATUS_REMINDED = 4;
    case STATUS_PROCESSING = 5;
    case STATUS_SEEN = 6;

    public static function fromName(string $name): self
    {
        foreach (self::cases() as $status) {
            if ($name === $status->name) {
                return $status;
            }
        }
        throw new ValueError("$name is not a valid value for enum ".self::class);
    }

    public static function toArray($property = 'name'): array
    {
        return array_column(OrderStatus::cases(), $property);
    }

    public static function toOptions(): array
    {
        $options = [];
        foreach (OrderStatus::cases() as $value) {
            $options[$value->value] = ucwords(strtolower(str_replace('STATUS_', '', $value->name)));
        }

        return $options;
    }

    public function name(): string
    {
        return match ($this) {
            self::STATUS_NEW => 'New',
            self::STATUS_APPROVED => 'Approved',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELLED => 'Cancelled',
            self::STATUS_REMINDED => 'Reminded',
            self::STATUS_PROCESSING => 'Proceesing',
            self::STATUS_SEEN => 'Seen'
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::STATUS_NEW => 'badge badge-light-primary',
            self::STATUS_APPROVED => 'badge badge-light-success',
            self::STATUS_COMPLETED => 'badge badge-light-info',
            self::STATUS_CANCELLED => 'badge badge-light-danger',
            self::STATUS_REMINDED => 'badge badge-light-warning',
            self::STATUS_PROCESSING => 'badge badge-light-info',
            self::STATUS_SEEN => 'badge badge-light-success'
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::STATUS_NEW => 'fc-event-new',
            self::STATUS_APPROVED => 'fc-event-approved',
            self::STATUS_COMPLETED => 'fc-event-completed',
            self::STATUS_CANCELLED => 'fc-event-cancelled',
            self::STATUS_REMINDED => 'fc-event-reminded',
            self::STATUS_PROCESSING => 'fc-event-processing',
            self::STATUS_SEEN => 'fc-event-seen'
        };
    }
}
