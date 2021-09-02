<?php

/**
 * This file was created by the developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.shop and write us
 * an email on kontakt@bitbag.pl.
 */

namespace Waaz\U2PayEtransactionsPlugin\Legacy;

use Payum\Core\Reply\HttpResponse;

/**
 * @author Mikołaj Król <mikolaj.krol@bitbag.pl>
 * @author Patryk Drapik <patryk.drapik@bitbag.pl>
 */
final class SimplePayment
{
    /**
     * @var Etransactions|object
     */
    private $etransactions;

    /**
     * @var string
     */
    private $rang;

    /**
     * @var string
     */
    private $identifiant;

    /**
     * @var string
     */
    private $site;

    /**
     * @var bool
     */
    private $sandbox;

    /**
     * @var string
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $transactionReference;

    /**
     * @var string
     */
    private $customerEmail;

    /**
     * @var string
     */
    private $automaticResponseUrl;

    /**
     * @param Etransactions $etransactions
     * @param $identifiant
     * @param $rang
     * @param $amount
     * @param $targetUrl
     * @param $currency
     * @param $transactionReference
     * @param $customerEmail
     * @param $automaticResponseUrl
     */
    public function __construct(
        Etransactions $etransactions,
        $identifiant,
        $rang,
        $site,
        $sandbox,
        $amount,
        $targetUrl,
        $currency,
        $transactionReference,
        $customerEmail,
        $automaticResponseUrl
    )
    {
        $this->automaticResponseUrl = $automaticResponseUrl;
        $this->transactionReference = $transactionReference;
        $this->etransactions = $etransactions;
        $this->rang = $rang;
        $this->site = $site;
        $this->sandbox = $sandbox;
        $this->identifiant = $identifiant;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->targetUrl = $targetUrl;
        $this->customerEmail = $customerEmail;
    }

    public function execute()
    {
        $this->resolveEnvironment();

        $this->etransactions->setSite($this->site);
        $this->etransactions->setRang($this->rang);
        $this->etransactions->setIdentifiant($this->identifiant);
        $this->etransactions->setAmount($this->amount);
        $this->etransactions->setCurrency($this->currency);
        $this->etransactions->setTransactionReference($this->transactionReference);
        $this->etransactions->setBillingContactEmail($this->customerEmail);
        //$this->etransactions->setInterfaceVersion(Etransactions::INTERFACE_VERSION);
        //$this->etransactions->setKeyVersion('1');
        $this->etransactions->setNormalReturnUrl($this->targetUrl);
        $this->etransactions->setHash("SHA512");
        $this->etransactions->setSource("RWD");
        $this->etransactions->setMerchantTransactionDateTime(date('c'));
        $this->etransactions->setAutomaticResponseUrl($this->automaticResponseUrl);

        $this->etransactions->validate();

        $response = $this->etransactions->executeRequest();

        throw new HttpResponse($response);
    }

    /**
     * @return void
     */
    private function resolveEnvironment()
    {
        if ($this->sandbox) {
            $this->etransactions->setUrl(Etransactions::TEST);
        } else {
            $this->etransactions->setUrl(Etransactions::PRODUCTION);
        }

        return;
    }
}
