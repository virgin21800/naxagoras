<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $contact = new Contact;
    
        $form = $this->createForm(ContactType::class, $contact);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contactForm = $form->getData();

            $serializer = new Serializer([new ObjectNormalizer()]);


            $contactFormData = $serializer->normalize($contactForm);
            var_dump($contactFormData);

            $message = (new \Swift_Message('You Got Mail!'))
               ->setFrom($contactFormData["email"])
               ->setTo('postmaster@localhost')
               ->setBody(
                   $contactFormData["message"],
                   'text/plain'
               )
           ;
          $mailer->send($message);

          return $this->redirectToRoute('contact');
        }

        return $this->render('/contact/contact.html.twig', [
             'our_form' => $form->createView(),
        ]);
        
    }
}
