<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200307133143 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE invalidite (id INT AUTO_INCREMENT NOT NULL, agent_saisie_id INT DEFAULT NULL, matricul_inv VARCHAR(7) NOT NULL, nom_agent_invalide VARCHAR(255) NOT NULL, sexe VARCHAR(255) DEFAULT NULL, date_nais DATE DEFAULT NULL, num_acte_inval VARCHAR(255) DEFAULT NULL, type_acte_inv VARCHAR(255) DEFAULT NULL, date_signature_inv DATE DEFAULT NULL, noms_inv_acte VARCHAR(255) DEFAULT NULL, date_invalidite DATE DEFAULT NULL, cc_inv INT DEFAULT NULL, cc INT DEFAULT NULL, resultat INT DEFAULT NULL, precontentieux INT DEFAULT NULL, INDEX IDX_73FAA17F5670B5A9 (agent_saisie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, equipe_id INT NOT NULL, full_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, hash VARCHAR(255) NOT NULL, INDEX IDX_8D93D6496D861B89 (equipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, responsable VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reversion (id INT AUTO_INCREMENT NOT NULL, agent_saisie_id INT DEFAULT NULL, matricul VARCHAR(7) NOT NULL, noms_ayant_droit VARCHAR(255) NOT NULL, sexe VARCHAR(255) DEFAULT NULL, date_nais DATE DEFAULT NULL, qualite_ayant_droit VARCHAR(255) DEFAULT NULL, date_nais_der_orph DATE DEFAULT NULL, ccay INT NOT NULL, cc INT DEFAULT NULL, date_affectat DATE DEFAULT NULL, an_emb INT DEFAULT NULL, noms_auteur VARCHAR(255) DEFAULT NULL, matricule_auteur VARCHAR(7) DEFAULT NULL, ministere VARCHAR(255) DEFAULT NULL, date_deces DATE DEFAULT NULL, noms_ad_acte VARCHAR(255) DEFAULT NULL, num_acte_revers VARCHAR(255) DEFAULT NULL, type_acte VARCHAR(255) DEFAULT NULL, date_signature_rev DATE DEFAULT NULL, conforme_y_n TINYINT(1) DEFAULT NULL, date_saisie_revers DATETIME DEFAULT NULL, resultat INT DEFAULT NULL, precontentieux INT DEFAULT NULL, INDEX IDX_82275D9F5670B5A9 (agent_saisie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE invalidite ADD CONSTRAINT FK_73FAA17F5670B5A9 FOREIGN KEY (agent_saisie_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE reversion ADD CONSTRAINT FK_82275D9F5670B5A9 FOREIGN KEY (agent_saisie_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE invalidite DROP FOREIGN KEY FK_73FAA17F5670B5A9');
        $this->addSql('ALTER TABLE reversion DROP FOREIGN KEY FK_82275D9F5670B5A9');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496D861B89');
        $this->addSql('DROP TABLE invalidite');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE reversion');
    }
}
