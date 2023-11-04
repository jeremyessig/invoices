<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231031155444 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accounting_entry ADD accounting_month_income_id INT DEFAULT NULL, ADD accounting_month_outcome_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE accounting_entry ADD CONSTRAINT FK_DB6C942A948F425B FOREIGN KEY (accounting_month_income_id) REFERENCES accounting_month (id)');
        $this->addSql('ALTER TABLE accounting_entry ADD CONSTRAINT FK_DB6C942A81C3A63F FOREIGN KEY (accounting_month_outcome_id) REFERENCES accounting_month (id)');
        $this->addSql('CREATE INDEX IDX_DB6C942A948F425B ON accounting_entry (accounting_month_income_id)');
        $this->addSql('CREATE INDEX IDX_DB6C942A81C3A63F ON accounting_entry (accounting_month_outcome_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accounting_entry DROP FOREIGN KEY FK_DB6C942A948F425B');
        $this->addSql('ALTER TABLE accounting_entry DROP FOREIGN KEY FK_DB6C942A81C3A63F');
        $this->addSql('DROP INDEX IDX_DB6C942A948F425B ON accounting_entry');
        $this->addSql('DROP INDEX IDX_DB6C942A81C3A63F ON accounting_entry');
        $this->addSql('ALTER TABLE accounting_entry DROP accounting_month_income_id, DROP accounting_month_outcome_id');
    }
}
