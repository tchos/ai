<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201213182613 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE regul_inv_clo ADD pto_permanent_y_n TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE regul_inv_susp ADD pto_permanent_y_n TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE regul_rev_clo ADD pto_permanent_y_n TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE regul_rev_susp ADD pto_permanent_y_n TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE regul_inv_clo DROP pto_permanent_y_n');
        $this->addSql('ALTER TABLE regul_inv_susp DROP pto_permanent_y_n');
        $this->addSql('ALTER TABLE regul_rev_clo DROP pto_permanent_y_n');
        $this->addSql('ALTER TABLE regul_rev_susp DROP pto_permanent_y_n');
    }
}
