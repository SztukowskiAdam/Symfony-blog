<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     *
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     *
     */
    private $shortVersionOfArticle;

    /**
     * @ORM\Column(type="text")
     *
     */
    private $longVersionOfArticle;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    private $dateOfArticle;
    

    // Getters and Setters
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getShortVersionOfArticle() {
        return $this->shortVersionOfArticle;
    }

    public function setShortVersionOfArticle($shortVersionOfArticle) {
        $this->shortVersionOfArticle = $shortVersionOfArticle;
    }

    public function getLongVersionOfArticle() {
        return $this->longVersionOfArticle;
    }

    public function setLongVersionOfArticle($longVersionOfArticle) {
        $this->longVersionOfArticle = $longVersionOfArticle;
    }

    public function getDateOfArticle() {
        return $this->dateOfArticle;
    }

    public function setDateOfArticle($dateOfArticle) {
        $this->dateOfArticle = $dateOfArticle;
    }
}
