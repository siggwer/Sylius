<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Behat\Page\Checkout;

use Sylius\Behat\Page\SymfonyPage;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
class CheckoutThankYouPage extends SymfonyPage implements CheckoutThankYouPageInterface
{
    /**
     * @var array
     */
    protected $elements = [
        'thank you message' => '#thanks',
    ];

    /**
     * {@inheritdoc}
     */
    public function hasThankYouMessageFor($name)
    {
        $thankYouMessage = $this->getElement('thank you message')->getText();

        return false !== strpos($thankYouMessage, sprintf('Thank you %s', $name));
    }

    /**
     * {@inheritdoc}
     */
    public function waitForResponse($timeout, array $parameters)
    {
        $this->getDocument()->waitFor($timeout, function () use ($parameters) {
            return $this->isOpen($parameters);
        });
    }

    /**
     * {@inheritdoc}
     */
    protected function getUrl(array $urlParameters = [])
    {
        if (!isset($urlParameters['id'])) {
            throw new \InvalidArgumentException(sprintf('This page %s requires order id to be passed as parameter', self::class));
        }

        return parent::getUrl($urlParameters);
    }

    /**
     * @return string
     */
    protected function getRouteName()
    {
        return 'sylius_checkout_thank_you';
    }
}
