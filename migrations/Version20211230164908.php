<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211230164908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE monthly_account DROP FOREIGN KEY FK_7163ED0F9B6B5FBA');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP INDEX IDX_7163ED0F9B6B5FBA ON monthly_account');
        $this->addSql('ALTER TABLE monthly_account DROP active, CHANGE account_id current_account_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', CHANGE slug state VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE monthly_account ADD CONSTRAINT FK_7163ED0F44D096C8 FOREIGN KEY (current_account_id) REFERENCES current_account (id)');
        $this->addSql('CREATE INDEX IDX_7163ED0F44D096C8 ON monthly_account (current_account_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', bank VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, category VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, author_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, balance NUMERIC(10, 2) NOT NULL, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE monthly_account DROP FOREIGN KEY FK_7163ED0F44D096C8');
        $this->addSql('DROP INDEX IDX_7163ED0F44D096C8 ON monthly_account');
        $this->addSql('ALTER TABLE monthly_account ADD active TINYINT(1) NOT NULL, CHANGE current_account_id account_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', CHANGE state slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE monthly_account ADD CONSTRAINT FK_7163ED0F9B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('CREATE INDEX IDX_7163ED0F9B6B5FBA ON monthly_account (account_id)');
    }
}
