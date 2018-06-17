<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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

    private $articleBody;

    /**
     * @ORM\Column(type="text")
     *@Assert\File(
     *     mimeTypes = {"image/jpeg", "image/png"},
     *     mimeTypesMessage = "Proszę podać zdjęcie w formacie .jpg lub .png"
     *     )
     */
    private $image;


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

    public function getArticleBody() {
        return $this->articleBody;
    }

    public function setArticleBody($articleBody) {
        $this->articleBody = $articleBody;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }
}
