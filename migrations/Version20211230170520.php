<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211230170520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE current_account_operation (id INT AUTO_INCREMENT NOT NULL, monthly_account_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', date_op DATE NOT NULL, category VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, credit NUMERIC(10, 2) NOT NULL, debit NUMERIC(10, 2) NOT NULL, checked TINYINT(1) NOT NULL, INDEX IDX_6FCB608252763F3F (monthly_account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE current_account_operation ADD CONSTRAINT FK_6FCB608252763F3F FOREIGN KEY (monthly_account_id) REFERENCES monthly_account (id)');
        $this->addSql('DROP TABLE operation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE operation (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', monthly_account_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', date_op DATE NOT NULL, category VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, credit NUMERIC(10, 2) DEFAULT NULL, debit NUMERIC(10, 2) DEFAULT NULL, checked TINYINT(1) NOT NULL, INDEX IDX_1981A66D52763F3F (monthly_account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D52763F3F FOREIGN KEY (monthly_account_id) REFERENCES monthly_account (id)');
        $this->addSql('DROP TABLE current_account_operation');
    }
}
