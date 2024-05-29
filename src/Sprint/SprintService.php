<?php

declare(strict_types=1);

namespace JiraRestApi\Sprint;

use JiraRestApi\Configuration\ConfigurationInterface;
use JiraRestApi\Issue\Issue;
use JiraRestApi\JiraClient;
use JiraRestApi\JiraException;
use Psr\Log\LoggerInterface;

class SprintService extends JiraClient
{
    private $uri = '/sprint';

    public function __construct(ConfigurationInterface $configuration = null, LoggerInterface $logger = null, $path = './')
    {
        parent::__construct($configuration, $logger, $path);
        $this->setAPIUri('/rest/agile/1.0');
    }

    /**
     * @param object $json JSON object structure from json_decode
     *
     * @throws \JsonMapper_Exception
     */
    public function getSprintFromJSON(object $json): Sprint
    {
        $sprint = $this->json_mapper->map(
            $json,
            new Sprint()
        );

        return $sprint;
    }

    public function getSprint(string|int $sprintId): Sprint
    {
        $ret = $this->exec($this->uri.'/'.$sprintId, null);

        $this->log->info("Result=\n".$ret);

        return $this->json_mapper->map(
            json_decode($ret),
            new Sprint()
        );
    }

    public function getSprintReport($boardId, string|int $sprintId): SprintReport
    {
        $this->setAPIUri('/rest/greenhopper/latest');
        $ret = $this->exec('/rapid/charts/sprintreport'.$this->toHttpQueryParameter(['rapidViewId' => $boardId, 'sprintId' => $sprintId]));

        $json = json_decode($ret);
        $json->sprint->startDate = $json->sprint->isoStartDate;
        $json->sprint->endDate = $json->sprint->isoEndDate;
        if ($json->contents) {
            foreach ($json->contents as $key => $value) {
                $json->$key = $value;

            }
            unset($json->contents);
        }

        return $this->json_mapper->map(
            $json,
            new SprintReport()
        );
    }

    /**
     * @throws JiraException
     * @throws \JsonMapper_Exception
     *
     * @return Issue[] array of Issue
     */
    public function getSprintIssues(string|int $sprintId, array $paramArray = [])
    {
        $json = $this->exec($this->uri.'/'.$sprintId.'/issue'.$this->toHttpQueryParameter($paramArray), null);

        $issues = $this->json_mapper->mapArray(
            json_decode($json)->issues,
            new \ArrayObject(),
            Issue::class
        );

        return $issues;
    }

    public function createSprint(Sprint $sprint): Sprint
    {
        $data = json_encode($sprint);

        $ret = $this->exec($this->uri, $data);

        $this->log->debug('createSprint result='.var_export($ret, true));

        return $this->json_mapper->map(
            json_decode($ret),
            new Sprint()
        );
    }

    /**
     * @see https://docs.atlassian.com/jira-software/REST/9.11.0/#agile/1.0/sprint-moveIssuesToSprint
     */
    public function moveIssues2Sprint(int $sprintId, Sprint $sprint): bool
    {
        $data = json_encode($sprint);

        $ret = $this->exec($this->uri.'/'.$sprintId.'/issue', $data);

        $this->log->debug('moveIssues2Sprint result='.var_export($ret, true));

        return $ret;
    }
}
