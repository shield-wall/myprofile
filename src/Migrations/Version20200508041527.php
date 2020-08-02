<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200508041527 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE fos_user DROP photo');
        $this->addSql('ALTER TABLE fos_user DROP background');
        $this->addSql('ALTER TABLE fos_user ALTER role TYPE VARCHAR(100)');
        $this->addSql('ALTER TABLE education ALTER period_end DROP NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE education ALTER period_end SET NOT NULL');
        $this->addSql('ALTER TABLE fos_user ADD photo VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD background VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ALTER role TYPE VARCHAR(50)');
    }
}
