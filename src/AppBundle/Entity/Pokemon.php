<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Pokemon.
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\PokemonRepository")
 * @ORM\Table(name="pokemon")
 */
class Pokemon
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="hp", type="smallint")
     */
    private $hp;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="smallint")
     */
    private $level;

    /**
     * @var integer
     *
     * @ORM\Column(name="attack", type="smallint")
     */
    private $attack;

    /**
     * @var integer
     *
     * @ORM\Column(name="defense", type="smallint")
     */
    private $defense;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Type")
     */
    private $types;

    /**
     * @var Trainer
     *
     * @ORM\ManyToOne(targetEntity="Trainer")
     */
    private $trainer;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->types = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Pokemon
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set hp.
     *
     * @param integer $hp
     *
     * @return Pokemon
     */
    public function setHp($hp)
    {
        $this->hp = $hp;

        return $this;
    }

    /**
     * Get hp.
     *
     * @return integer
     */
    public function getHp()
    {
        return $this->hp;
    }

    /**
     * Set level.
     *
     * @param integer $level
     *
     * @return Pokemon
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level.
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set attack.
     *
     * @param integer $attack
     *
     * @return Pokemon
     */
    public function setAttack($attack)
    {
        $this->attack = $attack;

        return $this;
    }

    /**
     * Get attack.
     *
     * @return integer
     */
    public function getAttack()
    {
        return $this->attack;
    }

    /**
     * Set defense.
     *
     * @param integer $defense
     *
     * @return Pokemon
     */
    public function setDefense($defense)
    {
        $this->defense = $defense;

        return $this;
    }

    /**
     * Get defense.
     *
     * @return integer
     */
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Pokemon
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add types.
     *
     * @param Type $types
     *
     * @return Pokemon
     */
    public function addType(Type $types)
    {
        $this->types[] = $types;

        return $this;
    }

    /**
     * Remove types.
     *
     * @param Type $types
     */
    public function removeType(Type $types)
    {
        $this->types->removeElement($types);
    }

    /**
     * Get types.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Set trainer.
     *
     * @param Trainer $trainer
     *
     * @return Pokemon
     */
    public function setTrainer(Trainer $trainer = null)
    {
        $this->trainer = $trainer;

        return $this;
    }

    /**
     * Get trainer.
     *
     * @return Trainer
     */
    public function getTrainer()
    {
        return $this->trainer;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
