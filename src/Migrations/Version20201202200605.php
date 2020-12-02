<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201202200605 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE regul_invalidite (id INT AUTO_INCREMENT NOT NULL, agent_saisie_id INT DEFAULT NULL, matricul VARCHAR(7) NOT NULL, nom_agent_invalide VARCHAR(255) NOT NULL, a_affect INT NOT NULL, num_acte_inval VARCHAR(255) DEFAULT NULL, type_acte VARCHAR(255) DEFAULT NULL, date_signature DATE DEFAULT NULL, nom_inv_acte VARCHAR(255) DEFAULT NULL, date_invalidite DATE DEFAULT NULL, date_nais_der_orph DATE DEFAULT NULL, cloture_y_n TINYINT(1) DEFAULT NULL, regulariser_y_n TINYINT(1) DEFAULT NULL, date_regul DATETIME DEFAULT NULL, INDEX IDX_DD610D5B5670B5A9 (agent_saisie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE regul_invalidite ADD CONSTRAINT FK_DD610D5B5670B5A9 FOREIGN KEY (agent_saisie_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE regul_invalidite');
    }
}
