<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200110150944 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE advisor ADD ideal_mission LONGTEXT DEFAULT NULL, ADD gouvernance_experience TINYINT(1) DEFAULT NULL, ADD mandate_state TINYINT(1) DEFAULT NULL, ADD mandate_contribution LONGTEXT DEFAULT NULL, ADD method LONGTEXT DEFAULT NULL, ADD gain LONGTEXT DEFAULT NULL, ADD realisation LONGTEXT DEFAULT NULL, ADD top_skill LONGTEXT DEFAULT NULL, ADD progress LONGTEXT DEFAULT NULL, ADD other_spec LONGTEXT DEFAULT NULL, ADD daily_rate DOUBLE PRECISION DEFAULT NULL, ADD avaibility VARCHAR(255) DEFAULT NULL, ADD rgpd TINYINT(1) DEFAULT NULL, ADD submission_date DATETIME DEFAULT NULL, DROP availability_start, DROP availability_end');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE advisor ADD availability_start DATE DEFAULT NULL, ADD availability_end DATE DEFAULT NULL, DROP ideal_mission, DROP gouvernance_experience, DROP mandate_state, DROP mandate_contribution, DROP method, DROP gain, DROP realisation, DROP top_skill, DROP progress, DROP other_spec, DROP daily_rate, DROP avaibility, DROP rgpd, DROP submission_date');
    }
}
