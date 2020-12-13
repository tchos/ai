<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201213174753 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE regul_inv_clo ADD ministere VARCHAR(32) DEFAULT NULL, ADD observation LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE regul_inv_susp ADD ministere VARCHAR(32) DEFAULT NULL, ADD observation LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE regul_rev_clo ADD ministere VARCHAR(32) DEFAULT NULL, ADD observation LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE regul_rev_susp ADD ministere VARCHAR(32) DEFAULT NULL, ADD observation LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE regul_inv_clo DROP ministere, DROP observation');
        $this->addSql('ALTER TABLE regul_inv_susp DROP ministere, DROP observation');
        $this->addSql('ALTER TABLE regul_rev_clo DROP ministere, DROP observation');
        $this->addSql('ALTER TABLE regul_rev_susp DROP ministere, DROP observation');
    }
}
