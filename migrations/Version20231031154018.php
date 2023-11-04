<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231031154018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accounting_entry DROP FOREIGN KEY FK_DB6C942AB2889016');
        $this->addSql('DROP INDEX IDX_DB6C942AB2889016 ON accounting_entry');
        $this->addSql('ALTER TABLE accounting_entry DROP accounting_month_id, CHANGE date date DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accounting_entry ADD accounting_month_id INT NOT NULL, CHANGE date date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE accounting_entry ADD CONSTRAINT FK_DB6C942AB2889016 FOREIGN KEY (accounting_month_id) REFERENCES accounting_month (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_DB6C942AB2889016 ON accounting_entry (accounting_month_id)');
    }
}
