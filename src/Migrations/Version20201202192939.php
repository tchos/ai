<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201202192939 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, matricule_auteur VARCHAR(7) NOT NULL, nom_auteur VARCHAR(255) NOT NULL, ministere_auteur VARCHAR(32) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE regul_reversion (id INT AUTO_INCREMENT NOT NULL, agent_saisie_id INT DEFAULT NULL, matricul VARCHAR(7) NOT NULL, noms_ayant_droit VARCHAR(255) NOT NULL, qualite_ayant_droit VARCHAR(255) NOT NULL, date_nais_der_orph DATE DEFAULT NULL, matricule_auteur VARCHAR(7) NOT NULL, date_deces DATE DEFAULT NULL, noms_ad_acte VARCHAR(255) DEFAULT NULL, num_acte_revers VARCHAR(255) DEFAULT NULL, type_acte VARCHAR(255) DEFAULT NULL, date_signature_rev DATE DEFAULT NULL, date_regul DATETIME DEFAULT NULL, cloture_y_n TINYINT(1) DEFAULT NULL, a_affect INT NOT NULL, regulariser_y_n TINYINT(1) NOT NULL, INDEX IDX_C8E133775670B5A9 (agent_saisie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE regul_reversion ADD CONSTRAINT FK_C8E133775670B5A9 FOREIGN KEY (agent_saisie_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE regul_reversion');
    }
}
