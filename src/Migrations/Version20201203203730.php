<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201203203730 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE regul_inv_susp (id INT AUTO_INCREMENT NOT NULL, agent_saisie_id INT DEFAULT NULL, matricul VARCHAR(7) NOT NULL, nom_agent_invalide VARCHAR(255) NOT NULL, a_affect INT NOT NULL, type_acte VARCHAR(64) DEFAULT NULL, date_signature DATE DEFAULT NULL, nom_inv_acte VARCHAR(255) DEFAULT NULL, date_invalidite DATE DEFAULT NULL, date_regul DATETIME DEFAULT NULL, cc INT NOT NULL, resultat INT NOT NULL, regulariser_y_n TINYINT(1) DEFAULT NULL, INDEX IDX_705BB2235670B5A9 (agent_saisie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE regul_inv_susp ADD CONSTRAINT FK_705BB2235670B5A9 FOREIGN KEY (agent_saisie_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE regul_inv_susp');
    }
}
