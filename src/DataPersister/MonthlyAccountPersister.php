<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\MonthlyAccount;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

class MonthlyAccountPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $_entityManager;

    /**
     * @param Security
     */
    private $_security;

    private $_slugger;

    /**
     * {@inheritdoc}
     */
    public function __construct(EntityManagerInterface $entityManager, Security $security, SluggerInterface $slugger)
    {
        $this->_entityManager = $entityManager;
        $this->_security = $security;
        $this->_slugger = $slugger;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof MonthlyAccount;
    }

    /**
     * @param MonthlyAccount $data
     */
    public function persist($data, array $context = [])
    {
        // Set the author if it's a new monthlyAccount
        if (($context['collection_operation_name'] ?? null) === 'post') {
            $data->setAuthor($this->_security->getUser());
        }

        // Set the slug
        $data->setSlug($this->_slugger->slug(date('F-Y', strtotime(strval($data->getYear()).strval($data->getMonth()).'01'))) . '-' . uniqid());

        $this->_entityManager->persist($data);
        $this->_entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function remove($data, array $context = [])
    {
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }
}
