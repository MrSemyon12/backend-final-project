<?php

namespace App\Entity;

use App\Repository\FavouriteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavouriteRepository::class)]
class Favourite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Film::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $film_id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $user_username;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilmId(): ?Film
    {
        return $this->film_id;
    }

    public function setFilmId(?Film $film_id): self
    {
        $this->film_id = $film_id;

        return $this;
    }

    public function getUserUsername(): ?User
    {
        return $this->user_username;
    }

    public function setUserUsername(?User $user_username): self
    {
        $this->user_username = $user_username;

        return $this;
    }
}
