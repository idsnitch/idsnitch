<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180323110330 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE license ADD issued_by_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE license ADD CONSTRAINT FK_5768F419784BB717 FOREIGN KEY (issued_by_id) REFERENCES organization (id)');
        $this->addSql('CREATE INDEX IDX_5768F419784BB717 ON license (issued_by_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE license DROP FOREIGN KEY FK_5768F419784BB717');
        $this->addSql('DROP INDEX IDX_5768F419784BB717 ON license');
        $this->addSql('ALTER TABLE license DROP issued_by_id');
    }
}
