<?php

namespace Morethingsdigital\VercelStatamic\Enums;

enum VercelStates: string
{
    case QUEUED = 'QUEUED';
    case INITIALIZING = 'INITIALIZING';
    case BUILDING = 'BUILDING';
    case READY = 'READY';
    case CANCELED = 'CANCELED';
    case ERROR = 'ERROR';
    case DELETED = 'DELETED';

    public function color(): string
    {
        return match ($this) {
            VercelStates::QUEUED => '#f97316',
            VercelStates::INITIALIZING => '#2563eb',
            VercelStates::BUILDING => '#fde047',
            VercelStates::READY => '#22c55e',
            VercelStates::CANCELED => '#6b7280',
            VercelStates::ERROR => '#ef4444',
            VercelStates::DELETED => '#000000',
        };
    }

    public function label(): string
    {
        return match ($this) {
            VercelStates::QUEUED => 'QUEUED',
            VercelStates::INITIALIZING => 'INITIALIZING',
            VercelStates::BUILDING => 'BUILDING',
            VercelStates::READY => 'READY',
            VercelStates::CANCELED => 'CANCELED',
            VercelStates::ERROR => 'ERROR',
            VercelStates::DELETED => 'DELETED',
        };
    }
}
