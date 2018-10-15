<?php

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ReviewsRepository extends EntityRepository
{
	public function findAllByNameAndAgeJoinedBooks(array $where)
	{
		$query = $this->getEntityManager()
			->createQuery(
				'SELECT b.name, b.bookDate, AVG(r.age) as avg_age, r.sex
				FROM AppBundle:Reviews r
				JOIN r.bookId b
				WHERE b.name '.$where['name']['condition'].' :name AND r.age '.$where['age']['condition'].' :age
				GROUP BY r.sex'
			);

		$query->setParameters([
			'name'	=> $where['name']['column'],
			'age'	=> $where['age']['column'],
		]);

		return $query->getArrayResult();
	}

	public function findAllByAgeJoinedBooksOrderBySex(array $where)
	{
		$query = $this->getEntityManager()
			->createQuery(
				'SELECT b.name, b.bookDate, AVG(r.age) as avg_age, r.sex
				FROM AppBundle:Reviews r
				JOIN r.bookId b
				WHERE r.age '.$where['age']['condition'].' :age
				GROUP BY r.sex, b.name'
			)
			->setParameter('age', $where['age']['column']);

		return $query->getArrayResult();
	}
}
