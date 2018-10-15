<?php

namespace AppBundle\Controller;


use AppBundle\Model\Statistic\StatsModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class StatsController extends Controller
{
	/**
	 * @Route("/", name="homepage")
	 */
	public function statisticAction()
	{
		$arrStatistics = $this->showStatistics("ZieLoNa MiLa|age>30");

		return $this->render('statistics/index.html.twig', [
			'arrStatistics' => $arrStatistics,
		]);
	}

	private function showStatistics(string $string1)
	{
		$stats = new StatsModel($this->getDoctrine());
		$arrStatistics = $stats->getStatistics($string1);

		return $arrStatistics;
	}
}
