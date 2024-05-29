<?php

declare(strict_types=1);

namespace JiraRestApi\Sprint;

use JiraRestApi\Issue\Issue;
use JiraRestApi\JsonSerializableTrait;

class SprintReportIssue extends Issue
{
    use JsonSerializableTrait;

    public string $summary;
}
