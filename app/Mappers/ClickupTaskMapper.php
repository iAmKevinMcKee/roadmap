<?php

namespace App\Mappers;

use App\Enums\Feature\FeatureStatus;
use App\Enums\Feature\FeatureType;
use Carbon\Carbon;

class ClickupTaskMapper
{
    private const PRIORITY_MAP = [
        'urgent' => 10,
        'high' => 7,
        'normal' => 5,
        'low' => 3,
    ];

    private const STATUS_MAP = [
        'to do' => FeatureStatus::Proposed,
        'open' => FeatureStatus::Proposed,
        'in progress' => FeatureStatus::InProgress,
        'review' => FeatureStatus::InProgress,
        'complete' => FeatureStatus::Completed,
        'done' => FeatureStatus::Completed,
        'closed' => FeatureStatus::Completed,
        'cancelled' => FeatureStatus::Cancelled,
        'canceled' => FeatureStatus::Cancelled,
    ];

    /**
     * @param  array<string, mixed>  $task
     * @return array<string, mixed>
     */
    public static function toFeatureAttributesArray(array $task): array
    {
        return [
            'name' => $task['name'] ?? '',
            'description' => $task['description'] ?? $task['text_content'] ?? '',
            'status' => self::mapStatus($task['status'] ?? null),
            'type' => self::mapType($task['tags'] ?? []),
            'priority' => self::mapPriority($task['priority'] ?? null),
            'target_delivery_date' => self::mapTimestamp($task['due_date'] ?? null),
            'delivered_at' => self::mapTimestamp($task['date_closed'] ?? null),
        ];
    }

    /**
     * @param  array{tasks: array<int, array<string, mixed>>}  $response
     * @return array<int, array<string, mixed>>
     */
    public static function getArrayOfFeatureAttributes(array $response): array
    {
        $tasks = $response['tasks'] ?? [];

        return array_map(
            fn (array $task) => self::toFeatureAttributesArray($task),
            $tasks
        );
    }

    public static function getCollectionOfFeatureAttributes(array $response): \Illuminate\Support\Collection
    {
        return collect(self::getArrayOfFeatureAttributes($response));
    }

    /**
     * @param  array{status?: string, type?: string}|null  $status
     */
    private static function mapStatus(?array $status): FeatureStatus
    {
        if ($status === null) {
            return FeatureStatus::Proposed;
        }

        $statusName = strtolower($status['status'] ?? '');

        return self::STATUS_MAP[$statusName] ?? FeatureStatus::Proposed;
    }

    /**
     * @param  array<int, array{name?: string}>  $tags
     */
    private static function mapType(array $tags): FeatureType
    {
        foreach ($tags as $tag) {
            if (strtolower($tag['name'] ?? '') === 'bug') {
                return FeatureType::Bug;
            }
        }

        return FeatureType::Feature;
    }

    /**
     * @param  array{priority?: string}|null  $priority
     */
    private static function mapPriority(?array $priority): int
    {
        if ($priority === null) {
            return 0;
        }

        $priorityName = strtolower($priority['priority'] ?? '');

        return self::PRIORITY_MAP[$priorityName] ?? 0;
    }

    private static function mapTimestamp(?string $timestamp): ?Carbon
    {
        if ($timestamp === null || $timestamp === '') {
            return null;
        }

        return Carbon::createFromTimestampMs((int) $timestamp);
    }
}
