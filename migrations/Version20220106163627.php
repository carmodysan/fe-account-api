<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220106163627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ref_index_grid (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', rank_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', echelon INT NOT NULL, month_duration INT NOT NULL, increase_index INT NOT NULL, gross_index INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, INDEX IDX_8365EE7A7616678F (rank_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ref_rank (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', level INT NOT NULL, label_long VARCHAR(255) NOT NULL, label_short VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ref_index_grid ADD CONSTRAINT FK_8365EE7A7616678F FOREIGN KEY (rank_id) REFERENCES ref_rank (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ref_index_grid DROP FOREIGN KEY FK_8365EE7A7616678F');
        $this->addSql('DROP TABLE ref_index_grid');
        $this->addSql('DROP TABLE ref_rank');
    }
}
