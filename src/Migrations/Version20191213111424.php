<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191213111424 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tag DROP FOREIGN KEY FK_389B78312469DE2');
        $this->addSql('ALTER TABLE advisor DROP FOREIGN KEY FK_19ADC9F4D262AF09');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE resume');
        $this->addSql('DROP INDEX IDX_389B78312469DE2 ON tag');
        $this->addSql('ALTER TABLE tag ADD category VARCHAR(255) NOT NULL, DROP category_id');
        $this->addSql('DROP INDEX IDX_19ADC9F4D262AF09 ON advisor');
        $this->addSql('ALTER TABLE advisor DROP resume_id, DROP commentary');
        $this->addSql('ALTER TABLE demand DROP deadline, CHANGE status status INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE resume (id INT AUTO_INCREMENT NOT NULL, demand_id INT DEFAULT NULL, content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_60C1D0A05D022E59 (demand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE resume ADD CONSTRAINT FK_60C1D0A05D022E59 FOREIGN KEY (demand_id) REFERENCES demand (id)');
        $this->addSql('ALTER TABLE advisor ADD resume_id INT DEFAULT NULL, ADD commentary LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE advisor ADD CONSTRAINT FK_19ADC9F4D262AF09 FOREIGN KEY (resume_id) REFERENCES resume (id)');
        $this->addSql('CREATE INDEX IDX_19ADC9F4D262AF09 ON advisor (resume_id)');
        $this->addSql('ALTER TABLE demand ADD deadline DATE DEFAULT NULL, CHANGE status status INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tag ADD category_id INT DEFAULT NULL, DROP category');
        $this->addSql('ALTER TABLE tag ADD CONSTRAINT FK_389B78312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_389B78312469DE2 ON tag (category_id)');
    }
}
