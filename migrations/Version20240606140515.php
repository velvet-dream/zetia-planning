<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240606140515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_user_usr (usr_id INT AUTO_INCREMENT NOT NULL, job_id INT NOT NULL, usr_name VARCHAR(127) NOT NULL, usr_first_name VARCHAR(127) NOT NULL, usr_mail VARCHAR(127) NOT NULL, usr_password VARCHAR(127) NOT NULL, usr_role VARCHAR(255) NOT NULL, usr_avatar VARCHAR(255) DEFAULT NULL, INDEX IDX_F4F448AABE04EA9 (job_id), PRIMARY KEY(usr_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ass_usertask_uts (usr_id INT NOT NULL, tsk_id INT NOT NULL, INDEX IDX_C371BD0EC69D3FB (usr_id), INDEX IDX_C371BD0EEA24184B (tsk_id), PRIMARY KEY(usr_id, tsk_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pct_task_tsk (tsk_id INT AUTO_INCREMENT NOT NULL, pct_id INT NOT NULL, stk_id INT NOT NULL, tsk_title VARCHAR(255) NOT NULL, tsk_date_debut DATETIME DEFAULT NULL, tsk_date_fin_previsionnelle DATETIME DEFAULT NULL, tsk_date_fin_reelle DATETIME DEFAULT NULL, tsk_description LONGTEXT NOT NULL, tsk_duree DOUBLE PRECISION NOT NULL, INDEX IDX_BC8BB0724501F4E3 (stk_id), INDEX IDX_BC8BB072192F8A16 (pct_id), PRIMARY KEY(tsk_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tsk_statusproject_stp (stp_id INT AUTO_INCREMENT NOT NULL, stp_title VARCHAR(127) NOT NULL, PRIMARY KEY(stp_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tsk_statustask_stk (stk_id INT AUTO_INCREMENT NOT NULL, stk_title VARCHAR(127) NOT NULL, PRIMARY KEY(stk_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usr_job_job (job_id INT AUTO_INCREMENT NOT NULL, job_title VARCHAR(127) NOT NULL, PRIMARY KEY(job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usr_project_pct (pct_id INT AUTO_INCREMENT NOT NULL, usr_id INT NOT NULL, stp_id INT NOT NULL, pct_title VARCHAR(127) NOT NULL, pct_description VARCHAR(255) DEFAULT NULL, pct_date_debut DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', pct_date_fin_previsionnelle DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', pct_date_fin_reelle DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', INDEX IDX_ABB5AAE0C69D3FB (usr_id), INDEX IDX_ABB5AAE0C219247D (stp_id), PRIMARY KEY(pct_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_user_usr ADD CONSTRAINT FK_F4F448AABE04EA9 FOREIGN KEY (job_id) REFERENCES usr_job_job (job_id)');
        $this->addSql('ALTER TABLE ass_usertask_uts ADD CONSTRAINT FK_C371BD0EC69D3FB FOREIGN KEY (usr_id) REFERENCES app_user_usr (usr_id)');
        $this->addSql('ALTER TABLE ass_usertask_uts ADD CONSTRAINT FK_C371BD0EEA24184B FOREIGN KEY (tsk_id) REFERENCES pct_task_tsk (tsk_id)');
        $this->addSql('ALTER TABLE pct_task_tsk ADD CONSTRAINT FK_BC8BB0724501F4E3 FOREIGN KEY (stk_id) REFERENCES tsk_statustask_stk (stk_id)');
        $this->addSql('ALTER TABLE pct_task_tsk ADD CONSTRAINT FK_BC8BB072192F8A16 FOREIGN KEY (pct_id) REFERENCES usr_project_pct (pct_id)');
        $this->addSql('ALTER TABLE usr_project_pct ADD CONSTRAINT FK_ABB5AAE0C69D3FB FOREIGN KEY (usr_id) REFERENCES app_user_usr (usr_id)');
        $this->addSql('ALTER TABLE usr_project_pct ADD CONSTRAINT FK_ABB5AAE0C219247D FOREIGN KEY (stp_id) REFERENCES tsk_statusproject_stp (stp_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_user_usr DROP FOREIGN KEY FK_F4F448AABE04EA9');
        $this->addSql('ALTER TABLE ass_usertask_uts DROP FOREIGN KEY FK_C371BD0EC69D3FB');
        $this->addSql('ALTER TABLE ass_usertask_uts DROP FOREIGN KEY FK_C371BD0EEA24184B');
        $this->addSql('ALTER TABLE pct_task_tsk DROP FOREIGN KEY FK_BC8BB0724501F4E3');
        $this->addSql('ALTER TABLE pct_task_tsk DROP FOREIGN KEY FK_BC8BB072192F8A16');
        $this->addSql('ALTER TABLE usr_project_pct DROP FOREIGN KEY FK_ABB5AAE0C69D3FB');
        $this->addSql('ALTER TABLE usr_project_pct DROP FOREIGN KEY FK_ABB5AAE0C219247D');
        $this->addSql('DROP TABLE app_user_usr');
        $this->addSql('DROP TABLE ass_usertask_uts');
        $this->addSql('DROP TABLE pct_task_tsk');
        $this->addSql('DROP TABLE tsk_statusproject_stp');
        $this->addSql('DROP TABLE tsk_statustask_stk');
        $this->addSql('DROP TABLE usr_job_job');
        $this->addSql('DROP TABLE usr_project_pct');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
