<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Contact;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    private $contact;

    public function setUp()
    {
        $this->contact = new Contact;
    }

    /** @test */
    public function that_we_can_get_first_name()
    {
        $this->contact->setFirstname('Venkat');
        $this->assertEquals($this->contact->getFirstname(),'Venkat');
   
    }

    /** @test */
    public function that_we_can_get_last_name()
    {
        $this->contact->setLastname('Mallina');
        $this->assertEquals($this->contact->getLastname(),'Mallina');
   
    }

    /** @test */
    public function that_we_can_get_street_number()
    {
        $this->contact->setStreetno('Alte Wohr');
        $this->assertEquals($this->contact->getStreetno(),'Alte Wohr');
   
    }

    /** @test */
    public function that_we_can_get_zipcode()
    {
        $this->contact->setZip('22307');
        $this->assertEquals($this->contact->getZip(),'22307');
   
    }

    /** @test */
    public function that_we_can_get_city()
    {
        $this->contact->setCity('Hamburg');
        $this->assertEquals($this->contact->getCity(),'Hamburg');
   
    }

    /** @test */
    public function that_we_can_get_country()
    {
        $this->contact->setCountry('Germany');
        $this->assertEquals($this->contact->getCountry(),'Germany');
   
    }

    /** @test */
    public function that_we_can_get_phone_number()
    {
        $this->contact->setPhonenumber('16786382637');
        $this->assertEquals($this->contact->getPhonenumber(),'16786382637');
   
    }

    /** @test */
    public function that_we_can_get_birthday()
    {
        $this->contact->setBirthday(new \DateTime('1979-08-12'));
        $this->assertEquals($this->contact->getBirthday(),new \DateTime('1979-08-12'));
   
    }

    /** @test */
    public function that_we_can_get_email()
    {
        $this->contact->setEmail('test@test.com');
        $this->assertEquals($this->contact->getEmail(),'test@test.com');
   
    }

    /** @test */
    public function that_we_can_get_picture()
    {
        $this->contact->setPicture(null);
        $this->assertEquals($this->contact->getPicture(),null);
   
    }

}