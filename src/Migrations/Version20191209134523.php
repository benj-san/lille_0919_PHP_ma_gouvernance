<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191209134523 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE advisor_board (advisor_id INT NOT NULL, board_id INT NOT NULL, INDEX IDX_149E4F5966D3AD77 (advisor_id), INDEX IDX_149E4F59E7EC5785 (board_id), PRIMARY KEY(advisor_id, board_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE advisor_board ADD CONSTRAINT FK_149E4F5966D3AD77 FOREIGN KEY (advisor_id) REFERENCES advisor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE advisor_board ADD CONSTRAINT FK_149E4F59E7EC5785 FOREIGN KEY (board_id) REFERENCES board (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE advisor_board');
    }
}
