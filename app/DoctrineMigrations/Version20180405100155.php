<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180405100155 extends AbstractMigration
{
	/**
	 * @param Schema $schema
	 *
	 * @throws \Doctrine\DBAL\Migrations\AbortMigrationException
	 */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product ADD description LONGTEXT DEFAULT NULL');
    }

	/**
	 * @param Schema $schema
	 *
	 * @throws \Doctrine\DBAL\Migrations\AbortMigrationException
	 */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP description');
    }
}
