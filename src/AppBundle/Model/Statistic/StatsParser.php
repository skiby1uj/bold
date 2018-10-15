<?php

namespace AppBundle\Model\Statistic;


class StatsParser
{
	public function parseStats(array $arrData, string $compatibilityPattern): array
	{
		$arrDataParsed = [];

		foreach ($arrData as $arrValue) {
			if (empty($arrDataParsed[$arrValue['name']])) {
				$arrDataParsed[$arrValue['name']] = [
					'name' 			=> $arrValue['name'],
					'compatibility' => $this->getCompatibilityPercent($arrValue['name'], $compatibilityPattern),
					'date' 			=> ($arrValue['bookDate'])->format('Y-m-d'),
					'femaleAge'		=> 0,
					'maleAge'		=> 0,
				];
			}

			if ($arrValue['sex'] == 'f') {
				$arrDataParsed[$arrValue['name']]['femaleAge'] = intval($arrValue['avg_age']);
			}
			else {
				$arrDataParsed[$arrValue['name']]['maleAge'] = intval($arrValue['avg_age']);
			}
		}

		return $this->arraySort($arrDataParsed, 'compatibility');
	}

	private function arraySort(array $array,string $columnSort): array
	{
		$arrSort = array();
		foreach ($array as $key => $row) {
			$arrSort[$key] = $row[$columnSort] ?? '';
		}

		array_multisort($arrSort, SORT_DESC, $array);

		return $array;
	}

	private function getCompatibilityPercent(string $firstText, string $secondText): float
	{
		$string1 = iconv('UTF-8', 'ASCII//TRANSLIT', strtolower($firstText));
		$string2 = iconv('UTF-8', 'ASCII//TRANSLIT', strtolower($secondText));

		similar_text( $string1, $string2, $percent);

		return round($percent, 2);
	}
}
