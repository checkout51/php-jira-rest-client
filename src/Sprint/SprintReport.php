<?php

declare(strict_types=1);

namespace JiraRestApi\Sprint;

use JiraRestApi\JsonSerializableTrait;

class SprintReport implements \JsonSerializable
{
    use JsonSerializableTrait;

    public string $self;

    public Sprint $sprint;

    /**
     * @var SprintReportIssue[]
     */
    public array $completedIssues;

    /**
     * @var SprintReportIssue[]
     */
    public array $issuesNotCompletedInCurrentSprint;

    /**
     * @var SprintReportIssue[]
     */
    public array $puntedIssues;

    public ?float $completedIssuesInitialEstimateSum;

    public ?float $completedIssuesEstimateSum;

    public ?float $issuesNotCompletedInitialEstimateSum;

    public ?float $issuesNotCompletedEstimateSum;

    public ?float $allIssuesEstimateSum;

    public ?float $puntedIssuesInitialEstimateSum;

    public ?float $puntedIssuesEstimateSum;

    public ?float $issuesCompletedInAnotherSprintInitialEstimateSum;

    public ?float $issuesCompletedInAnotherSprintEstimateSum;

    public function setCompletedIssuesInitialEstimateSum(?object $completedIssuesInitialEstimateSum): void
    {
        $this->completedIssuesInitialEstimateSum = $completedIssuesInitialEstimateSum->value ?? null;
    }

    public function setCompletedIssuesEstimateSum(?object $completedIssuesEstimateSum): void
    {
        $this->completedIssuesEstimateSum = $completedIssuesEstimateSum->value ?? null;
    }

    public function setIssuesNotCompletedInitialEstimateSum(?object $issuesNotCompletedInitialEstimateSum): void
    {
        $this->issuesNotCompletedInitialEstimateSum = $issuesNotCompletedInitialEstimateSum->value ?? null;
    }

    public function setIssuesNotCompletedEstimateSum(?object $issuesNotCompletedEstimateSum): void
    {
        $this->issuesNotCompletedEstimateSum = $issuesNotCompletedEstimateSum->value ?? null;
    }

    public function setAllIssuesEstimateSum(?object $allIssuesEstimateSum): void
    {
        $this->allIssuesEstimateSum = $allIssuesEstimateSum->value ?? null;
    }

    public function setPuntedIssuesInitialEstimateSum(?object $puntedIssuesInitialEstimateSum): void
    {
        $this->puntedIssuesInitialEstimateSum = $puntedIssuesInitialEstimateSum->value ?? null;
    }

    public function setPuntedIssuesEstimateSum(?object $puntedIssuesEstimateSum): void
    {
        $this->puntedIssuesEstimateSum = $puntedIssuesEstimateSum->value ?? null;
    }

    public function setIssuesCompletedInAnotherSprintInitialEstimateSum(?object $issuesCompletedInAnotherSprintInitialEstimateSum): void
    {
        $this->issuesCompletedInAnotherSprintInitialEstimateSum = $issuesCompletedInAnotherSprintInitialEstimateSum->value ?? null;
    }

    public function setIssuesCompletedInAnotherSprintEstimateSum(?object $issuesCompletedInAnotherSprintEstimateSum): void
    {
        $this->issuesCompletedInAnotherSprintEstimateSum = $issuesCompletedInAnotherSprintEstimateSum->value ?? null;
    }
}
