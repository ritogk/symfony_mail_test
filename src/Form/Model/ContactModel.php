<?php

namespace App\Form\Model;

class ContactModel
{
  public function __serialize(): array
  {
    return [
      'contactContent' => $this->contactContent,
    ];
  }

  public function __unserialize(array $data): void
  {
    $this->contactContent = $data['contactContent'];
  }

  protected $contactContent;
  private array $image = [];

  public function getContactContent(): string
  {
    return $this->contactContent;
  }

  public function setContactContent(string $contactContent): void
  {
    $this->contactContent = $contactContent;
  }

  public function getImage(): array
  {
    return $this->image;
  }

  public function setImage(array $image): self
  {
    $this->image = $image;
    return $this;
  }
}
