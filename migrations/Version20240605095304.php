<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240605095304 extends AbstractMigration
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
        $this->addSql('CREATE TABLE user (usr_id INT AUTO_INCREMENT NOT NULL, usr_name VARCHAR(90) NOT NULL, usr_first_name VARCHAR(50) NOT NULL, usr_mail VARCHAR(50) NOT NULL, usr_password VARCHAR(150) NOT NULL, usr_role VARCHAR(250) NOT NULL, pst_id INT NOT NULL, PRIMARY KEY(usr_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clt_billing_bil DROP FOREIGN KEY clt_billing_bil_ibfk_1');
        $this->addSql('ALTER TABLE clt_billing_bil DROP FOREIGN KEY clt_billing_bil_ibfk_2');
        $this->addSql('ALTER TABLE clt_billing_bil DROP FOREIGN KEY clt_billing_bil_ibfk_3');
        $this->addSql('ALTER TABLE pct_task_tsk DROP FOREIGN KEY pct_task_tsk_ibfk_1');
        $this->addSql('ALTER TABLE pct_task_tsk DROP FOREIGN KEY pct_task_tsk_ibfk_2');
        $this->addSql('ALTER TABLE tem_project_pct DROP FOREIGN KEY tem_project_pct_ibfk_1');
        $this->addSql('ALTER TABLE tem_project_pct DROP FOREIGN KEY tem_project_pct_ibfk_2');
        $this->addSql('ALTER TABLE tem_project_pct DROP FOREIGN KEY tem_project_pct_ibfk_3');
        $this->addSql('ALTER TABLE app_user_usr DROP FOREIGN KEY app_user_usr_ibfk_1');
        $this->addSql('ALTER TABLE a_pour_mission DROP FOREIGN KEY a_pour_mission_ibfk_1');
        $this->addSql('ALTER TABLE a_pour_mission DROP FOREIGN KEY a_pour_mission_ibfk_2');
        $this->addSql('DROP TABLE clt_billing_bil');
        $this->addSql('DROP TABLE clt_billingadress_bad');
        $this->addSql('DROP TABLE pct_client_clt');
        $this->addSql('DROP TABLE pct_statusproject_stp');
        $this->addSql('DROP TABLE pct_task_tsk');
        $this->addSql('DROP TABLE tem_project_pct');
        $this->addSql('DROP TABLE tsk_statustask_stk');
        $this->addSql('DROP TABLE usr_poste_pst');
        $this->addSql('DROP TABLE app_user_usr');
        $this->addSql('DROP TABLE a_pour_mission');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clt_billing_bil (bil_id INT NOT NULL, pct_id INT NOT NULL, bad_id INT NOT NULL, clt_id INT NOT NULL, bil_number VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, bil_billing_date DATE DEFAULT NULL, bil_deadline_date DATE NOT NULL, bil_hours_spent INT DEFAULT NULL, bil_total_price NUMERIC(15, 2) DEFAULT NULL, bil_hour_cost NUMERIC(15, 2) DEFAULT NULL, bil_client_name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, INDEX clt_id (clt_id), INDEX bad_id (bad_id), INDEX pct_id (pct_id), PRIMARY KEY(bil_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE clt_billingadress_bad (bad_id INT NOT NULL, bad_adress VARCHAR(250) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, bad_zipcode VARCHAR(12) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, bad_country VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(bad_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pct_client_clt (clt_id INT NOT NULL, clt_name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, clt_siret VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, clt_phone VARCHAR(15) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, clt_mail VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(clt_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pct_statusproject_stp (stp_id INT NOT NULL, stp_title VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(stp_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pct_task_tsk (tsk_id INT NOT NULL, pct_id INT NOT NULL, stk_id INT NOT NULL, tsk_title VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, tsk_date_debut DATE DEFAULT NULL, tsk_date_fin_previsionnelle DATE DEFAULT NULL, tsk_description TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, tsk_date_fin_reelle DATE DEFAULT NULL, tsk_duree INT DEFAULT NULL, INDEX stk_id (stk_id), INDEX pct_id (pct_id), PRIMARY KEY(tsk_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tem_project_pct (pct_id INT NOT NULL, usr_id INT NOT NULL, clt_id INT DEFAULT NULL, stp_id INT NOT NULL, pct_title VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, pct_date_debut DATE NOT NULL, pct_date_fin_previsionnelle DATE DEFAULT NULL, pct_date_fin_reelle DATE DEFAULT NULL, pct_description TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, INDEX stp_id (stp_id), INDEX clt_id (clt_id), INDEX usr_id (usr_id), PRIMARY KEY(pct_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tsk_statustask_stk (stk_id INT NOT NULL, stk_title VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(stk_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE usr_poste_pst (pst_id INT NOT NULL, pst_title VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(pst_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE app_user_usr (usr_id INT NOT NULL, pst_id INT NOT NULL, usr_name VARCHAR(90) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, usr_first_name VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, usr_mail VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, usr_password VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, usr_role VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, INDEX pst_id (pst_id), PRIMARY KEY(usr_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE a_pour_mission (usr_id INT NOT NULL, tsk_id INT NOT NULL, INDEX tsk_id (tsk_id), INDEX IDX_46CD7F71C69D3FB (usr_id), PRIMARY KEY(usr_id, tsk_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE clt_billing_bil ADD CONSTRAINT clt_billing_bil_ibfk_1 FOREIGN KEY (pct_id) REFERENCES tem_project_pct (pct_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE clt_billing_bil ADD CONSTRAINT clt_billing_bil_ibfk_2 FOREIGN KEY (bad_id) REFERENCES clt_billingadress_bad (bad_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE clt_billing_bil ADD CONSTRAINT clt_billing_bil_ibfk_3 FOREIGN KEY (clt_id) REFERENCES pct_client_clt (clt_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE pct_task_tsk ADD CONSTRAINT pct_task_tsk_ibfk_1 FOREIGN KEY (pct_id) REFERENCES tem_project_pct (pct_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE pct_task_tsk ADD CONSTRAINT pct_task_tsk_ibfk_2 FOREIGN KEY (stk_id) REFERENCES tsk_statustask_stk (stk_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE tem_project_pct ADD CONSTRAINT tem_project_pct_ibfk_1 FOREIGN KEY (usr_id) REFERENCES app_user_usr (usr_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE tem_project_pct ADD CONSTRAINT tem_project_pct_ibfk_2 FOREIGN KEY (clt_id) REFERENCES pct_client_clt (clt_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE tem_project_pct ADD CONSTRAINT tem_project_pct_ibfk_3 FOREIGN KEY (stp_id) REFERENCES pct_statusproject_stp (stp_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE app_user_usr ADD CONSTRAINT app_user_usr_ibfk_1 FOREIGN KEY (pst_id) REFERENCES usr_poste_pst (pst_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE a_pour_mission ADD CONSTRAINT a_pour_mission_ibfk_1 FOREIGN KEY (usr_id) REFERENCES app_user_usr (usr_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE a_pour_mission ADD CONSTRAINT a_pour_mission_ibfk_2 FOREIGN KEY (tsk_id) REFERENCES pct_task_tsk (tsk_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE poste');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE status_project');
        $this->addSql('DROP TABLE status_task');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
