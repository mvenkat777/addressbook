<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Contact;
use AppBundle\Service\FileUploader;

class ContactController extends Controller
{
    /**
     * Matches /contacts exactly
     *
     * @Route("/contacts", name="contacts")
     */
    public function listAction(Request $request)
    {
        $contacts = $this->getDoctrine()->getRepository(Contact::class)->findAllOrderedByFirstName();         
        return $this->render('contacts/view.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'contacts' => $contacts,
        ]);
    }

    /**
     * Matches /view-add-contact exactly
     *
     * @Route("/view-add-contact", name="view_add_contact")
     */
    public function viewAddContact()
    {
        return $this->render('contacts/add.html.twig');
    }

    /**
     * Matches /add-contact exactly
     *
     * @Route("/add-contact", name="contact_add")
     * @method("POST")
     * 
     */
    public function contactsAddAction(Request $request, FileUploader $fileUploader)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $contact = new Contact();
        $contact->setFirstname($request->get('firstname'));
        $contact->setLastname($request->get('lastname'));
        $contact->setEmail($request->get('email'));
        $contact->setBirthday(new \DateTime($request->get('birthday')));
        $contact->setStreetno($request->get('street'));
        $contact->setPhonenumber($request->get('phonenumber'));
        $contact->setZip($request->get('zip'));
        $contact->setCity($request->get('city'));
        $contact->setCountry($request->get('country'));
        

        $file = $request->files->get('picture');
        if ($file) {
            $uploadedFileName = $fileUploader->upload($file, $this->getParameter('upload_images'));
            $contact->setPicture($uploadedFileName);
        }
        
        $entityManager->persist($contact);

        $entityManager->flush();

        
        return $this->redirectToRoute('contacts');
    }

    /**
     * @Route("/edit-contact/{id}", name="editContact")
     */
    public function viewEditContact($id)
    {
        $contact = $this->getDoctrine()->getRepository(Contact::class)->find($id);
        if (!$contact) {
            $this->addFlash('error', 'Contact not found!');
            return $this->redirectToRoute('contacts');
        }
        return $this->render('contacts/edit.html.twig', ['contact' => $contact]);
    }

    /**
     * 
     * @Route("/edit-contact-process/{id}", name="contact_edit_process")
     * @method("POST")
     * 
     */
    public function contactsEditAction(Request $request, $id, FileUploader $fileUploader)
    {
        
        $entityManager = $this->getDoctrine()->getManager();
        $contact = $this->getDoctrine()->getRepository(Contact::class)->find($id);

        $contact->setFirstname($request->get('firstname'));
        $contact->setLastname($request->get('lastname'));
        $contact->setEmail($request->get('email'));
        $contact->setBirthday(new \DateTime($request->get('birthday')));
        $contact->setStreetno($request->get('street'));
        $contact->setPhonenumber($request->get('phonenumber'));
        $contact->setZip($request->get('zip'));
        $contact->setCity($request->get('city'));
        $contact->setCountry($request->get('country'));
        
        $file = $request->files->get('picture');
        if ($file) {
            $uploadedFileName = $fileUploader->upload($file, $this->getParameter('upload_images'));
            $contact->setPicture($uploadedFileName);
        }

        $entityManager->flush();
        return $this->redirectToRoute('contacts');

    }

    /**
     * @Route("/delete-contact/{id}", name="deleteContact")
     */
    public function deleteContact($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $contact = $this->getDoctrine()->getRepository(Contact::class)->find($id);
        $entityManager->remove($contact);
        $entityManager->flush();

        return $this->redirectToRoute('contacts');
    }

}
