<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220115090738 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE interest_rate (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', savings_account_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', rate NUMERIC(10, 2) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, INDEX IDX_71C2BFB5FCB8D9DE (savings_account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE savings_account_operation (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', savings_account_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', date_op DATE NOT NULL, credit NUMERIC(10, 2) NOT NULL, debit NUMERIC(10, 2) NOT NULL, INDEX IDX_E44F2B36FCB8D9DE (savings_account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE interest_rate ADD CONSTRAINT FK_71C2BFB5FCB8D9DE FOREIGN KEY (savings_account_id) REFERENCES savings_account (id)');
        $this->addSql('ALTER TABLE savings_account_operation ADD CONSTRAINT FK_E44F2B36FCB8D9DE FOREIGN KEY (savings_account_id) REFERENCES savings_account (id)');
        $this->addSql('ALTER TABLE savings_account DROP interest_rate');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE interest_rate');
        $this->addSql('DROP TABLE savings_account_operation');
        $this->addSql('ALTER TABLE savings_account ADD interest_rate NUMERIC(10, 2) NOT NULL');
    }
}
