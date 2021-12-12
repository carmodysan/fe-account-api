<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Account;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * Persister pour effectuer des actions particulières avant la persistence
 */
class AccountPersister implements ContextAwareDataPersisterInterface
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
        return $data instanceof Account;
    }

    /**
     * @param Account $data
     */
    public function persist($data, array $context = [])
    {
        $this->_logger->debug('===> Persisting...');

        // Set the slug
        $formatBank = $this->cleanString($data->getBank());
        $formatCat = $this->cleanString($data->getCategory());
        // TODO Check that slug total size is under 255 charactere
        $data->setSlug($this->_slugger->slug($formatBank . '-' . $formatCat . '-' . uniqid()));

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

    // TODO Faire une classe utilitaire
    /**
     * Remove all special charactere from a string obgjet
     *
     * @param string $string
     * @return string
     */
    private function cleanString($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

        return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
    }
}
