<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240605144009 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (clt_id INT AUTO_INCREMENT NOT NULL, clt_name VARCHAR(50) NOT NULL, clt_siret VARCHAR(20) DEFAULT NULL, clt_phone VARCHAR(15) DEFAULT NULL, clt_mail VARCHAR(50) DEFAULT NULL, PRIMARY KEY(clt_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poste (pst_id INT AUTO_INCREMENT NOT NULL, pst_title VARCHAR(50) DEFAULT NULL, PRIMARY KEY(pst_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status_project (stp_id INT AUTO_INCREMENT NOT NULL, stp_title VARCHAR(50) NOT NULL, PRIMARY KEY(stp_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status_task (stk_id INT AUTO_INCREMENT NOT NULL, stk_title VARCHAR(50) NOT NULL, PRIMARY KEY(stk_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, usr_name VARCHAR(255) NOT NULL, usr_first_name VARCHAR(255) NOT NULL, usr_mail VARCHAR(255) NOT NULL, usr_password VARCHAR(255) NOT NULL, usr_role VARCHAR(50) NOT NULL, pst_id INT NOT NULL, UNIQUE INDEX UNIQ_1483A5E9D0D90DAF (usr_mail), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE poste');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE status_project');
        $this->addSql('DROP TABLE status_task');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
