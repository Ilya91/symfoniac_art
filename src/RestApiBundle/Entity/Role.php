<?php

namespace RestApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use RestApiBundle\Annotation as App;

/**
 * @ORM\Table(name="role")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoleRepository")
 */
class Role
{
	/**
	 * @var int
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id()
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var Person
	 * @ORM\ManyToOne(targetEntity="Person")
	 * @App\DeserializeEntity(type="RestApiBundle\Entity\Person", idField="id", idGetter="getId", setter="setPerson")
	 */
	private $person;

	/**
	 * @var string
	 * @ORM\Column(name="played_name", type="string", length=100)
	 */
	private $playedName;

	/**
	 * @var Movie
	 * @ORM\ManyToOne(targetEntity="Movie", inversedBy="roles")
	 */
	private $movie;

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return Person
	 */
	public function getPerson()
	{
		return $this->person;
	}

	/**
	 * @param Person $person
	 */
	public function setPerson(Person $person)
	{
		$this->person = $person;
	}

	/**
	 * @return string
	 */
	public function getPlayedName()
	{
		return $this->playedName;
	}

	/**
	 * @param string $playedName
	 */
	public function setPlayedName($playedName)
	{
		$this->playedName = $playedName;
	}

	/**
	 * @return Movie
	 */
	public function getMovie()
	{
		return $this->movie;
	}

	/**
	 * @param Movie $movie
	 */
	public function setMovie($movie)
	{
		$this->movie = $movie;
	}
}