<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PaymentControllerTest extends WebTestCase
{
    public function testPaymentPageLoads(): void
    {
        $client = static::createClient();
        $client->request('GET', '/pay');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Payment Information');
    }

    public function testPaymentFormSubmission(): void
    {
        $client = static::createClient();
        
        $crawler = $client->request('GET', '/pay');
        
        $form = $crawler->selectButton('Pay Now')->form();
        
        // Fill in form data
        $form['credit_card[cardNumber]'] = '4111111111111111';
        $form['credit_card[expirationDate][month]'] = '12';
        $form['credit_card[expirationDate][year]'] = '2025';
        $form['credit_card[cvv]'] = '123';
        
        // Billing address
        $form['credit_card[billingAddress][firstName]'] = 'John';
        $form['credit_card[billingAddress][lastName]'] = 'Doe';
        $form['credit_card[billingAddress][country]'] = 'US';
        $form['credit_card[billingAddress][addressLine1]'] = '123 Main St';
        $form['credit_card[billingAddress][city]'] = 'New York';
        $form['credit_card[billingAddress][state]'] = 'NY';
        $form['credit_card[billingAddress][zipCode]'] = '10001';
        $form['credit_card[billingAddress][phoneNumber]'] = '+15551234567';
        $form['credit_card[billingAddress][emailAddress]'] = 'john@example.com';
        
        // Shipping address
        $form['credit_card[shippingAddress][shippingOption]'] = 'same_as_billing';
        
        $client->submit($form);
        
        $this->assertResponseRedirects();
        
        // Follow redirect
        $client->followRedirect();
        
        $this->assertSelectorExists('.alert-success');
    }
}
