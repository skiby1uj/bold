<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reviews
 *
 * @ORM\Table(name="reviews", indexes={@ORM\Index(name="book_id", columns={"book_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReviewsRepository")
 */
class Reviews
{
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;

	/**
	 * @var \AppBundle\Entity\Books
	 *
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Books")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="book_id", referencedColumnName="id")
	 * })
	 */
	private $bookId;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer", nullable=false)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=1 nullable=false)
     */
    private $sex;

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @return Books
	 */
	public function getBookId(): Books
	{
		return $this->bookId;
	}

	/**
	 * @return int
	 */
	public function getAge(): int
	{
		return $this->age;
	}

	/**
	 * @return string
	 */
	public function getSex(): string
	{
		return $this->sex;
	}
}
