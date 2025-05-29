<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SignupControllerTest extends WebTestCase
{
    public function testDisplaySignupForm()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/signup');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h3', 'Créer un compte');
    }

    public function testSubmitSignupFormWithValidData()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/signup');
        $form = $crawler->selectButton("S'inscrire")->form([
            'signup_form[firstName]' => 'Alice',
            'signup_form[lastName]' => 'Smith',
            'signup_form[email]' => 'alice'.uniqid().'@example.com',
            'signup_form[phone]' => '0601020304',
            'signup_form[birthDate]' => '1990-01-01',
            'signup_form[gender]' => 'femme',
            'signup_form[address]' => '1 rue de la Paix',
            'signup_form[password]' => 'Password123!',
            'signup_form[confirm_password]' => 'Password123!',
            'signup_form[acceptedTerms]' => 1,
        ]);
        $client->submit($form);
        $this->assertResponseRedirects();
    }
} 