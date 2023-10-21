<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231021110633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE accounting_category (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, INDEX IDX_BEC83433727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accounting_entry (id INT AUTO_INCREMENT NOT NULL, accounting_month_id INT NOT NULL, owner_id INT NOT NULL, accounting_category_id INT NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', amount INT NOT NULL, label VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, is_income TINYINT(1) NOT NULL, INDEX IDX_DB6C942AB2889016 (accounting_month_id), INDEX IDX_DB6C942A7E3C61F9 (owner_id), INDEX IDX_DB6C942A6EF92732 (accounting_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accounting_month (id INT AUTO_INCREMENT NOT NULL, accounting_year_id INT NOT NULL, owner_id INT NOT NULL, label VARCHAR(255) NOT NULL, start_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', end_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7EFB195C79490390 (accounting_year_id), INDEX IDX_7EFB195C7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accounting_planned (id INT AUTO_INCREMENT NOT NULL, accounting_month_id INT NOT NULL, accounting_category_id INT NOT NULL, owner_id INT NOT NULL, label VARCHAR(255) NOT NULL, amount INT NOT NULL, description LONGTEXT DEFAULT NULL, is_income TINYINT(1) NOT NULL, INDEX IDX_580D3F07B2889016 (accounting_month_id), INDEX IDX_580D3F076EF92732 (accounting_category_id), INDEX IDX_580D3F077E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accounting_tag (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accounting_tag_accounting_entry (accounting_tag_id INT NOT NULL, accounting_entry_id INT NOT NULL, INDEX IDX_76DF9A3A319C96F2 (accounting_tag_id), INDEX IDX_76DF9A3A2B264B0 (accounting_entry_id), PRIMARY KEY(accounting_tag_id, accounting_entry_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accounting_year (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, start_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', end_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_F9186DA77E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE accounting_category ADD CONSTRAINT FK_BEC83433727ACA70 FOREIGN KEY (parent_id) REFERENCES accounting_category (id)');
        $this->addSql('ALTER TABLE accounting_entry ADD CONSTRAINT FK_DB6C942AB2889016 FOREIGN KEY (accounting_month_id) REFERENCES accounting_month (id)');
        $this->addSql('ALTER TABLE accounting_entry ADD CONSTRAINT FK_DB6C942A7E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE accounting_entry ADD CONSTRAINT FK_DB6C942A6EF92732 FOREIGN KEY (accounting_category_id) REFERENCES accounting_category (id)');
        $this->addSql('ALTER TABLE accounting_month ADD CONSTRAINT FK_7EFB195C79490390 FOREIGN KEY (accounting_year_id) REFERENCES accounting_year (id)');
        $this->addSql('ALTER TABLE accounting_month ADD CONSTRAINT FK_7EFB195C7E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE accounting_planned ADD CONSTRAINT FK_580D3F07B2889016 FOREIGN KEY (accounting_month_id) REFERENCES accounting_month (id)');
        $this->addSql('ALTER TABLE accounting_planned ADD CONSTRAINT FK_580D3F076EF92732 FOREIGN KEY (accounting_category_id) REFERENCES accounting_category (id)');
        $this->addSql('ALTER TABLE accounting_planned ADD CONSTRAINT FK_580D3F077E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE accounting_tag_accounting_entry ADD CONSTRAINT FK_76DF9A3A319C96F2 FOREIGN KEY (accounting_tag_id) REFERENCES accounting_tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE accounting_tag_accounting_entry ADD CONSTRAINT FK_76DF9A3A2B264B0 FOREIGN KEY (accounting_entry_id) REFERENCES accounting_entry (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE accounting_year ADD CONSTRAINT FK_F9186DA77E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accounting_category DROP FOREIGN KEY FK_BEC83433727ACA70');
        $this->addSql('ALTER TABLE accounting_entry DROP FOREIGN KEY FK_DB6C942AB2889016');
        $this->addSql('ALTER TABLE accounting_entry DROP FOREIGN KEY FK_DB6C942A7E3C61F9');
        $this->addSql('ALTER TABLE accounting_entry DROP FOREIGN KEY FK_DB6C942A6EF92732');
        $this->addSql('ALTER TABLE accounting_month DROP FOREIGN KEY FK_7EFB195C79490390');
        $this->addSql('ALTER TABLE accounting_month DROP FOREIGN KEY FK_7EFB195C7E3C61F9');
        $this->addSql('ALTER TABLE accounting_planned DROP FOREIGN KEY FK_580D3F07B2889016');
        $this->addSql('ALTER TABLE accounting_planned DROP FOREIGN KEY FK_580D3F076EF92732');
        $this->addSql('ALTER TABLE accounting_planned DROP FOREIGN KEY FK_580D3F077E3C61F9');
        $this->addSql('ALTER TABLE accounting_tag_accounting_entry DROP FOREIGN KEY FK_76DF9A3A319C96F2');
        $this->addSql('ALTER TABLE accounting_tag_accounting_entry DROP FOREIGN KEY FK_76DF9A3A2B264B0');
        $this->addSql('ALTER TABLE accounting_year DROP FOREIGN KEY FK_F9186DA77E3C61F9');
        $this->addSql('DROP TABLE accounting_category');
        $this->addSql('DROP TABLE accounting_entry');
        $this->addSql('DROP TABLE accounting_month');
        $this->addSql('DROP TABLE accounting_planned');
        $this->addSql('DROP TABLE accounting_tag');
        $this->addSql('DROP TABLE accounting_tag_accounting_entry');
        $this->addSql('DROP TABLE accounting_year');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
