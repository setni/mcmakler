<?php
// src/NeoNasaBundle/Document/Neorepo.php
namespace NeoNasaBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Neorepo
{
    /**
     * @MongoDB\Id
     */
    protected $id;
    
    /**
     * @MongoDB\Field(type="date")
     */
    protected $date;
    
    /**
     * @MongoDB\Field(type="string")
     */
    protected $nom;
    
    /**
     * @MongoDB\Field(type="integer")
     */
    protected $reference;
    
    /**
     * @MongoDB\Field(type="float")
     */
    protected $speed;
    
    /**
     * @MongoDB\Field(type="boolean")
     */
    protected $hazardous;
    

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param date $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return datetime $date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set reference
     *
     * @param integer $reference
     * @return $this
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * Get reference
     *
     * @return integer $reference
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set speed
     *
     * @param float $speed
     * @return $this
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
        return $this;
    }

    /**
     * Get speed
     *
     * @return float $speed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set hazardous
     *
     * @param boolean $hazardous
     * @return $this
     */
    public function setHazardous($hazardous)
    {
        $this->hazardous = $hazardous;
        return $this;
    }

    /**
     * Get hazardous
     *
     * @return boolean $hazardous
     */
    public function getHazardous()
    {
        return $this->hazardous;
    }

    /**
     * Set nom
     *
     * @param text $nom
     * @return $this
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * Get nom
     *
     * @return text $nom
     */
    public function getNom()
    {
        return $this->nom;
    }
}
