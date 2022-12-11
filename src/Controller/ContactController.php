<?php

namespace App\Controller;

use App\Form\Type\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Form\Model\ContactModel;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class ContactController extends AbstractController
{
  #[Route('/contact', methods: ['GET'])]
  public function getContact(): Response
  {
    $contact = new ContactModel();
    $contact->setContactContent('画面がバグってます');

    $form = $this->createForm(ContactType::class, $contact);

    return $this->render('contact.html.twig', [
      'form' => $form,
    ]);
  }

  #[Route('/contact', methods: ['POST'])]
  public function postContact(Request $request, MailerInterface $mailer): Response
  {
    $contact = new ContactModel();
    $form = $this->createForm(ContactType::class, $contact);
    // formと値オブジェクトを紐づける
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $contact = $form->getData();

      // dd($task);

      $email = (new TemplatedEmail())
        ->from('hello@example.com')
        ->to('you@example.com')
        ->subject('symfony mail test title')
        ->textTemplate('emails/email.html.twig')
        ->context([
          'contact' => $contact,
        ]);

      foreach ($contact->getImage() as $attachmentFile) {
        $email->attachFromPath(
          $attachmentFile->getRealPath(),
          $attachmentFile->getClientOriginalName(),
        );
      }
      $mailer->send($email);
    }

    return $this->render('index.html.twig', [
      'form' => $form,
    ]);
  }
}
