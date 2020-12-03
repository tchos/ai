<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201203201010 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE regul_rev_clo (id INT AUTO_INCREMENT NOT NULL, agent_saisie_id INT DEFAULT NULL, matricul VARCHAR(7) NOT NULL, noms_ayant_droit VARCHAR(255) NOT NULL, qualite_ayant_droit VARCHAR(32) DEFAULT NULL, date_nais_der_orph DATE DEFAULT NULL, matricule_auteur VARCHAR(7) DEFAULT NULL, date_deces DATE DEFAULT NULL, noms_ad_acte VARCHAR(255) DEFAULT NULL, num_acte_revers VARCHAR(255) DEFAULT NULL, type_acte VARCHAR(64) DEFAULT NULL, date_signature_rev DATE DEFAULT NULL, date_regul DATETIME DEFAULT NULL, a_affect INT NOT NULL, cc INT NOT NULL, resultat INT NOT NULL, INDEX IDX_A215B2835670B5A9 (agent_saisie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE regul_rev_clo ADD CONSTRAINT FK_A215B2835670B5A9 FOREIGN KEY (agent_saisie_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE regul_rev_clo');
    }
}
