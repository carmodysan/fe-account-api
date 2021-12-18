<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\MonthlyAccount;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * Persister pour effectuer des actions particulières avant la persistence
 */
class MonthlyAccountPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $_entityManager;

    /**
     * @var SluggerInterface
     */
    private $_slugger;

    /**
     * @var LoggerInterface
     */
    private $_logger;

    /**
     * {@inheritdoc}
     */
    public function __construct(EntityManagerInterface $entityManager, SluggerInterface $slugger, LoggerInterface $logger)
    {
        $this->_entityManager = $entityManager;
        $this->_slugger = $slugger;
        $this->_logger = $logger;
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
        $this->_logger->debug('===> Persisting...');

        // Set the slug
        $date = DateTime::createFromFormat('n-Y', $data->getMonth().'-'.$data->getYear());
        $formatDate = strtolower($date->format('F-Y'));
        $this->_logger->debug('Format date : '.$formatDate);
        $data->setSlug($this->_slugger->slug($formatDate. '-' . uniqid()));

        // set the active state
        $data->setActive(false);

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
