<?php

namespace AppBundle\Model\Statistic;


use AppBundle\Entity\Reviews;

class StatsModel
{
	private $statsRequest;
	private $statsParser;
	private $managerRegistry;

	public function __construct(\Doctrine\Common\Persistence\ManagerRegistry $managerRegistry)
	{
		$this->statsRequest = new StatsRequest();
		$this->statsParser = new StatsParser();
		$this->managerRegistry = $managerRegistry;
	}

	public function getStatistics(string $strData): array
	{
		$arrWhere = $this->statsRequest->getWhereCondition($strData);

		$response = $this->managerRegistry->getRepository(Reviews::class)
			->findAllByNameAndAgeJoinedBooks($arrWhere);

		$searchBookName = $arrWhere['name']['column'];

		if (empty($response)) {
			$arrWhere = $this->statsRequest->removeColumnCondition('name');

			$response = $this->managerRegistry->getRepository(Reviews::class)
				->findAllByAgeJoinedBooksOrderBySex($arrWhere);
		}

		return $this->statsParser->parseStats($response, $searchBookName);
	}
}
