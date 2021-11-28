<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211128145502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE periodic_operation DROP FOREIGN KEY FK_9AEB66C0F675F31B');
        $this->addSql('DROP INDEX IDX_9AEB66C0F675F31B ON periodic_operation');
        $this->addSql('ALTER TABLE periodic_operation CHANGE author_id author_id VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE periodic_operation CHANGE author_id author_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE periodic_operation ADD CONSTRAINT FK_9AEB66C0F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9AEB66C0F675F31B ON periodic_operation (author_id)');
    }
}
