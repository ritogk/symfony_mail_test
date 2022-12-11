<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
  #[Route('/email')]
  public function sendEmail(MailerInterface $mailer): Response
  {
    $email = (new Email())
      ->from('hello@example.com')
      ->to('you@example.com')
      ->subject('symfony mail test title')
      ->text('メール内容はないよう');

    $mailer->send($email);

    return $this->render('index.html.twig');
  }
}
