<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\Component\Basket;

use Sonata\Component\Currency\CurrencyDetectorInterface;
use Sonata\Component\Customer\CustomerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;

/**
 * Class BaseBasketFactory.
 *
 *
 * @author Hugo Briand <briand@ekino.com>
 */
abstract class BaseBasketFactory implements BasketFactoryInterface, LogoutHandlerInterface
{
    const SESSION_BASE_NAME = 'sonata/basket/factory/customer/';

    /**
     * @var \Sonata\Component\Basket\BasketManagerInterface
     */
    protected $basketManager;

    /**
     * @var \Sonata\Component\Basket\BasketBuilderInterface
     */
    protected $basketBuilder;

    /**
     * @var \Sonata\Component\Currency\CurrencyDetectorInterface
     */
    protected $currencyDetector;

    /**
     * @var \Symfony\Component\HttpFoundation\Session\SessionInterface
     */
    protected $session;

    /**
     * @param BasketManagerInterface    $basketManager
     * @param BasketBuilderInterface    $basketBuilder
     * @param CurrencyDetectorInterface $currencyDetector
     * @param SessionInterface          $session
     */
    public function __construct(BasketManagerInterface $basketManager, BasketBuilderInterface $basketBuilder, CurrencyDetectorInterface $currencyDetector, SessionInterface $session)
    {
        $this->basketManager    = $basketManager;
        $this->basketBuilder    = $basketBuilder;
        $this->currencyDetector = $currencyDetector;
        $this->session          = $session;
    }

    /**
     * {@inheritdoc}
     */
    public function load(CustomerInterface $customer)
    {
        $basket = $this->getFromSession($customer);

        if (!$basket) {
            $basket = $this->basketManager->create();
            $basket->setLocale($customer->getLocale());
            $basket->setCurrency($this->currencyDetector->getCurrency());
        }

        $basket->setCustomer($customer);
        $this->basketBuilder->build($basket);

        return $basket;
    }

    /**
     * Retrieved basket associated with $customer from session.
     *
     * @param CustomerInterface $customer
     *
     * @return BasketInterface|null
     */
    protected function getFromSession(CustomerInterface $customer)
    {
        $basket = $this->session->get($this->getSessionVarName($customer));

        if ($basket && !$basket->isEmpty()) {
            return $basket;
        }

        return $this->session->get($this->getSessionVarName());
    }

    /**
     * Stores $basket in session.
     *
     * @param BasketInterface $basket
     */
    protected function storeInSession(BasketInterface $basket)
    {
        $this->session->set($this->getSessionVarName($basket->getCustomer()), $basket);
    }

    /**
     * {@inheritdoc}
     */
    public function logout(Request $request, Response $response, TokenInterface $token)
    {
        // Remove anonymous basket
        $this->session->remove($this->getSessionVarName());
    }

    /**
     * Get the name of the session variable.
     *
     * @param \Sonata\Component\Customer\CustomerInterface $customer
     *
     * @return string
     */
    protected function getSessionVarName(CustomerInterface $customer = null)
    {
        if (null === $customer || null === $customer->getId()) {
            return self::SESSION_BASE_NAME.'new';
        }

        return self::SESSION_BASE_NAME.$customer->getId();
    }

    /**
     * Clears the baskets in session.
     *
     * @param CustomerInterface $customer
     */
    protected function clearSession(CustomerInterface $customer)
    {
        $this->session->remove($this->getSessionVarName($customer));
        $this->session->remove($this->getSessionVarName());
    }
}
