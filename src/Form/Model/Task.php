<?php

namespace App\Form\Model;

class Task
{
  public function __serialize(): array
  {
    return [
      'task' => $this->task,
      'dueDate' => $this->dueDate,
    ];
  }

  public function __unserialize(array $data): void
  {
    $this->task = $data['task'];
    $this->dueDate = $data['dueDate'];
  }

  protected $task;
  protected $dueDate;
  /**
   * @var UploadedFile[]
   */
  private array $tenpu = [];

  public function getTask(): string
  {
    return $this->task;
  }

  public function setTask(string $task): void
  {
    $this->task = $task;
  }

  public function getDueDate(): ?\DateTime
  {
    return $this->dueDate;
  }

  public function setDueDate(?\DateTime $dueDate): void
  {
    $this->dueDate = $dueDate;
  }

  /**
   * @return UploadedFile[]
   */
  public function getTenpu(): array
  {
    return $this->tenpu;
  }

  /**
   * @param UploadedFile[] $tenpu
   */
  public function setTenpu(array $tenpu): self
  {
    $this->tenpu = $tenpu;

    return $this;
  }
}
