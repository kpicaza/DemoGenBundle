<?php
namespace AppBundle\Model\Post;
/**
 * PostInterface.
 */
interface PostInterface
{
    /**
     * Get id.
     */
    public function getId();

    /**
     * Get title.
     */
    public function getTitle();

    /**
     * Set title.
     */
    public function setTitle($title);

    /**
     * Get description.
     */
    public function getDescription();

    /**
     * Set description.
     */
    public function setDescription($description);

    /**
     * Get created.
     */
    public function getCreated();

    /**
     * Set \DateTime created.
     */
    public function setCreated(\DateTime $created);

    /**
     * Get updated.
     */
    public function getUpdated();

    /**
     * Set \DateTime updated.
     */
    public function setUpdated(\DateTime $updated);


}