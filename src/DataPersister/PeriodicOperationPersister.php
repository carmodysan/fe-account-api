<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\PeriodicOperation;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * Persister pour effectuer des actions particulières avant la persistence
 */
class PeriodicOperationPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $_entityManager;

    /**
     * @param Security
     */
    private $_security;

    /**
     * @var LoggerInterface
     */
    private $_logger;

    /**
     * {@inheritdoc}
     */
    public function __construct(EntityManagerInterface $entityManager, Security $security, LoggerInterface $logger)
    {
        $this->_entityManager = $entityManager;
        $this->_security = $security;
        $this->_logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof PeriodicOperation;
    }

    /**
     * @param PeriodicOperation $data
     */
    public function persist($data, array $context = [])
    {
        $this->_logger->debug('===> Persisting...');

        // Set the author if it's a new monthlyAccount
        /*if (($context['collection_operation_name'] ?? null) === 'post') {
            $data->setAuthor($this->_security->getUser());
        }

        // Set the slug
        $date = DateTime::createFromFormat('n-Y', $data->getMonth().'-'.$data->getYear());
        $formatDate = strtolower($date->format('F-Y'));
        $this->_logger->debug('Format date : '.$formatDate);
        $data->setSlug($this->_slugger->slug($formatDate. '-' . uniqid()));*/

        $this->_logger->debug(' ======================== '.$data->getAuthorId());

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
