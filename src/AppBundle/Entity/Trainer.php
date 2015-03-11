<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trainer.
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TrainerRepository")
 * @ORM\Table(name="trainer")
 */
class Trainer
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
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date")
     */
    private $birthday;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sex", type="boolean")
     */
    private $sex;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    const SEX_FEMALE = false;
    const SEX_MALE   = true;

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
     * @return Trainer
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
     * Set birthday.
     *
     * @param \DateTime $birthday
     *
     * @return Trainer
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday.
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set sex.
     *
     * @param boolean $sex
     *
     * @return Trainer
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex.
     *
     * @return boolean
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set picture.
     *
     * @param string $picture
     *
     * @return Trainer
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture.
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Trainer
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
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
