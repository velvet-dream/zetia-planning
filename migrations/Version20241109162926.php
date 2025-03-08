<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241109162926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE organization_org (org_id INT AUTO_INCREMENT NOT NULL, org_name VARCHAR(255) NOT NULL, PRIMARY KEY(org_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organizationusers_ous (org_id INT NOT NULL, usr_id INT NOT NULL, INDEX IDX_D58DE8CEF4837C1B (org_id), INDEX IDX_D58DE8CEC69D3FB (usr_id), PRIMARY KEY(org_id, usr_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usertask_uts (usr_id INT NOT NULL, tsk_id INT NOT NULL, INDEX IDX_6CE3E82DC69D3FB (usr_id), INDEX IDX_6CE3E82DEA24184B (tsk_id), PRIMARY KEY(usr_id, tsk_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE organizationusers_ous ADD CONSTRAINT FK_D58DE8CEF4837C1B FOREIGN KEY (org_id) REFERENCES organization_org (org_id)');
        $this->addSql('ALTER TABLE organizationusers_ous ADD CONSTRAINT FK_D58DE8CEC69D3FB FOREIGN KEY (usr_id) REFERENCES user_usr (usr_id)');
        $this->addSql('ALTER TABLE usertask_uts ADD CONSTRAINT FK_6CE3E82DC69D3FB FOREIGN KEY (usr_id) REFERENCES user_usr (usr_id)');
        $this->addSql('ALTER TABLE usertask_uts ADD CONSTRAINT FK_6CE3E82DEA24184B FOREIGN KEY (tsk_id) REFERENCES task_tsk (tsk_id)');
        $this->addSql('ALTER TABLE usertask DROP FOREIGN KEY FK_F403A354C69D3FB');
        $this->addSql('ALTER TABLE usertask DROP FOREIGN KEY FK_F403A354EA24184B');
        $this->addSql('DROP TABLE usertask');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE usertask (usr_id INT NOT NULL, tsk_id INT NOT NULL, INDEX IDX_F403A354EA24184B (tsk_id), INDEX IDX_F403A354C69D3FB (usr_id), PRIMARY KEY(usr_id, tsk_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE usertask ADD CONSTRAINT FK_F403A354C69D3FB FOREIGN KEY (usr_id) REFERENCES user_usr (usr_id)');
        $this->addSql('ALTER TABLE usertask ADD CONSTRAINT FK_F403A354EA24184B FOREIGN KEY (tsk_id) REFERENCES task_tsk (tsk_id)');
        $this->addSql('ALTER TABLE organizationusers_ous DROP FOREIGN KEY FK_D58DE8CEF4837C1B');
        $this->addSql('ALTER TABLE organizationusers_ous DROP FOREIGN KEY FK_D58DE8CEC69D3FB');
        $this->addSql('ALTER TABLE usertask_uts DROP FOREIGN KEY FK_6CE3E82DC69D3FB');
        $this->addSql('ALTER TABLE usertask_uts DROP FOREIGN KEY FK_6CE3E82DEA24184B');
        $this->addSql('DROP TABLE organization_org');
        $this->addSql('DROP TABLE organizationusers_ous');
        $this->addSql('DROP TABLE usertask_uts');
    }
}
