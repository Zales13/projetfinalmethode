<?php

namespace App\Model;

class RickAndMortyModel{
    private $name;
    private $image;

    public function __construct(string $name = "", string $image = ""){
      $this->name  = $name;
      $this->image = $image;
    }

    public function setName(string $name): self{
        $this->name = $name;
        return $this;
    }

    public function getName(): string{
        return $this->name;
    }

    
    public function setImage(string $image): self{
        $this->image = $image;
        return $this;
    }

    public function getImage(): string{
        return $this->image;
    }
}