<?php

namespace AppBundle\Model\Statistic;


class StatsRequest
{
	private $where;

	public function __construct()
	{
		$this->where = [];
	}

	public function removeColumnCondition(string $column): array
	{
		if (isset($this->where[$column])) {
			unset($this->where[$column]);
		}
		return $this->where;
	}

	public function getWhereCondition(string $data): array
	{
		$this->parseData($data);

		return $this->where;
	}

	private function parseData(string $data)
	{
		$arrData = explode("|", $data);

		$dataAge = array_pop($arrData);

		$this->setAge($dataAge);

		$this->setTitle($arrData);
	}

	private function setTitle(array $arrTitle): void
	{
		$this->where['name']['column'] = implode("", $arrTitle);
		$this->where['name']['condition'] = "LIKE";
	}

	private function setAge(string $data): void
	{
		preg_match('!\d+!', $data, $matches);
		$this->where['age']['column'] = $matches[0] ?? 0;

		$data = str_replace('age', '', $data);
		trim($data);

		$this->where['age']['condition'] = $data[0];
	}
}
