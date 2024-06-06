<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240606104753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_user_usr (usr_id INT AUTO_INCREMENT NOT NULL, job_id INT NOT NULL, usr_name VARCHAR(127) NOT NULL, usr_first_name VARCHAR(127) NOT NULL, usr_mail VARCHAR(127) NOT NULL, usr_password VARCHAR(127) NOT NULL, usr_role VARCHAR(255) NOT NULL, usr_avatar VARCHAR(255) DEFAULT NULL, INDEX IDX_F4F448AABE04EA9 (job_id), PRIMARY KEY(usr_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ass_usertask_uts (user_usrId INT NOT NULL, task_tskId INT NOT NULL, INDEX IDX_C371BD0E504981BB (user_usrId), INDEX IDX_C371BD0E5BB8D08C (task_tskId), PRIMARY KEY(user_usrId, task_tskId)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pct_task_tsk (tsk_id INT AUTO_INCREMENT NOT NULL, tsk_status_id INT NOT NULL, project_id INT NOT NULL, tsk_title VARCHAR(255) NOT NULL, tsk_date_debut DATETIME DEFAULT NULL, tsk_date_fin_previsionnelle DATETIME DEFAULT NULL, tsk_date_fin_reelle DATETIME DEFAULT NULL, tsk_description LONGTEXT NOT NULL, tsk_duree DOUBLE PRECISION NOT NULL, pct_id INT NOT NULL, stk_id INT NOT NULL, INDEX IDX_BC8BB07290F9DB3E (tsk_status_id), INDEX IDX_BC8BB072166D1F9C (project_id), PRIMARY KEY(tsk_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tsk_statusproject_stp (stp_id INT AUTO_INCREMENT NOT NULL, stp_title VARCHAR(127) NOT NULL, PRIMARY KEY(stp_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tsk_statustask_stk (stk_id INT AUTO_INCREMENT NOT NULL, stk_title VARCHAR(127) NOT NULL, PRIMARY KEY(stk_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usr_job_job (job_id INT AUTO_INCREMENT NOT NULL, job_title VARCHAR(127) NOT NULL, PRIMARY KEY(job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usr_project_pct (pct_id INT AUTO_INCREMENT NOT NULL, project_admin_id INT NOT NULL, pct_status_id INT NOT NULL, pct_title VARCHAR(127) NOT NULL, pct_description VARCHAR(255) DEFAULT NULL, pct_date_debut DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', pct_date_fin_previsionnelle DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', pct_date_fin_reelle DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', INDEX IDX_ABB5AAE0596509CB (project_admin_id), INDEX IDX_ABB5AAE061566C59 (pct_status_id), PRIMARY KEY(pct_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_user_usr ADD CONSTRAINT FK_F4F448AABE04EA9 FOREIGN KEY (job_id) REFERENCES usr_job_job (jobId)');
        $this->addSql('ALTER TABLE ass_usertask_uts ADD CONSTRAINT FK_C371BD0E504981BB FOREIGN KEY (user_usrId) REFERENCES app_user_usr (usrId)');
        $this->addSql('ALTER TABLE ass_usertask_uts ADD CONSTRAINT FK_C371BD0E5BB8D08C FOREIGN KEY (task_tskId) REFERENCES pct_task_tsk (tskId)');
        $this->addSql('ALTER TABLE pct_task_tsk ADD CONSTRAINT FK_BC8BB07290F9DB3E FOREIGN KEY (tsk_status_id) REFERENCES tsk_statustask_stk (stkId)');
        $this->addSql('ALTER TABLE pct_task_tsk ADD CONSTRAINT FK_BC8BB072166D1F9C FOREIGN KEY (project_id) REFERENCES usr_project_pct (pctId)');
        $this->addSql('ALTER TABLE usr_project_pct ADD CONSTRAINT FK_ABB5AAE0596509CB FOREIGN KEY (project_admin_id) REFERENCES app_user_usr (usrId)');
        $this->addSql('ALTER TABLE usr_project_pct ADD CONSTRAINT FK_ABB5AAE061566C59 FOREIGN KEY (pct_status_id) REFERENCES tsk_statusproject_stp (stpId)');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE poste');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE status_project');
        $this->addSql('DROP TABLE status_task');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE messenger_messages CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE available_at available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (clt_id INT AUTO_INCREMENT NOT NULL, clt_name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, clt_siret VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, clt_phone VARCHAR(15) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, clt_mail VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(clt_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE poste (pst_id INT AUTO_INCREMENT NOT NULL, pst_title VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(pst_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE status_project (stp_id INT AUTO_INCREMENT NOT NULL, stp_title VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(stp_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE status_task (stk_id INT AUTO_INCREMENT NOT NULL, stk_title VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(stk_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (usr_id INT AUTO_INCREMENT NOT NULL, usr_name VARCHAR(90) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, usr_first_name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, usr_mail VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, usr_password VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, usr_role VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, pst_id INT NOT NULL, PRIMARY KEY(usr_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE app_user_usr DROP FOREIGN KEY FK_F4F448AABE04EA9');
        $this->addSql('ALTER TABLE ass_usertask_uts DROP FOREIGN KEY FK_C371BD0E504981BB');
        $this->addSql('ALTER TABLE ass_usertask_uts DROP FOREIGN KEY FK_C371BD0E5BB8D08C');
        $this->addSql('ALTER TABLE pct_task_tsk DROP FOREIGN KEY FK_BC8BB07290F9DB3E');
        $this->addSql('ALTER TABLE pct_task_tsk DROP FOREIGN KEY FK_BC8BB072166D1F9C');
        $this->addSql('ALTER TABLE usr_project_pct DROP FOREIGN KEY FK_ABB5AAE0596509CB');
        $this->addSql('ALTER TABLE usr_project_pct DROP FOREIGN KEY FK_ABB5AAE061566C59');
        $this->addSql('DROP TABLE app_user_usr');
        $this->addSql('DROP TABLE ass_usertask_uts');
        $this->addSql('DROP TABLE pct_task_tsk');
        $this->addSql('DROP TABLE tsk_statusproject_stp');
        $this->addSql('DROP TABLE tsk_statustask_stk');
        $this->addSql('DROP TABLE usr_job_job');
        $this->addSql('DROP TABLE usr_project_pct');
        $this->addSql('ALTER TABLE messenger_messages CHANGE created_at created_at DATETIME NOT NULL, CHANGE available_at available_at DATETIME NOT NULL, CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}
