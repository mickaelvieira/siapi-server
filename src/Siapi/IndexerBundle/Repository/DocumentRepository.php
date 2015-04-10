<?php


namespace Siapi\IndexerBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Siapi\IndexerBundle\Entity\Document;

/**
 * Class DocumentRepository
 * @package Siapi\IndexerBundle\Repository
 */
final class DocumentRepository extends EntityRepository
{

    /**
     * @param \Siapi\IndexerBundle\Entity\Document[] $documents
     */
    public function addDocuments(array $documents)
    {
        foreach ($documents as $document) {
            $this->addDocument($document);
        }
    }

    /**
     * @param \Siapi\IndexerBundle\Entity\Document $document
     */
    public function addDocument(Document $document)
    {
        $this->getEntityManager()->persist($document);
    }

    /**
     *
     */
    public function sync()
    {
        $this->getEntityManager()->flush();
    }
}
