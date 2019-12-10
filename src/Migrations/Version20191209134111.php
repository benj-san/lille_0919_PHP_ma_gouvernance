<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191209134111 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tag_advisor (tag_id INT NOT NULL, advisor_id INT NOT NULL, INDEX IDX_2B9CE45EBAD26311 (tag_id), INDEX IDX_2B9CE45E66D3AD77 (advisor_id), PRIMARY KEY(tag_id, advisor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_demand (tag_id INT NOT NULL, demand_id INT NOT NULL, INDEX IDX_ABCC305FBAD26311 (tag_id), INDEX IDX_ABCC305F5D022E59 (demand_id), PRIMARY KEY(tag_id, demand_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tag_advisor ADD CONSTRAINT FK_2B9CE45EBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_advisor ADD CONSTRAINT FK_2B9CE45E66D3AD77 FOREIGN KEY (advisor_id) REFERENCES advisor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_demand ADD CONSTRAINT FK_ABCC305FBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_demand ADD CONSTRAINT FK_ABCC305F5D022E59 FOREIGN KEY (demand_id) REFERENCES demand (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tag_advisor');
        $this->addSql('DROP TABLE tag_demand');
    }
}
