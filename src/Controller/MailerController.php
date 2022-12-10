<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\File;

class MailerController extends AbstractController
{
  #[Route('/email')]
  public function sendEmail(MailerInterface $mailer): Response
  {
    $email = (new Email())
      ->from('hello@example.com')
      ->to('you@example.com')
      //->cc('cc@example.com')
      //->bcc('bcc@example.com')
      //->replyTo('fabien@example.com')
      //->priority(Email::PRIORITY_HIGH)
      ->subject('Time for Symfony Mailer!')
      ->text('Sending emails is fun again!')
      ->html('<p>See Twig integration for better HTML integration!</p>')
      ->addPart(new DataPart(new File('/path/to/images/dog.jpg')));

    $mailer->send($email);

    return $this->render('conference/index.html.twig', [
      'controller_name' => 'ConferenceController',
    ]);
  }
}
