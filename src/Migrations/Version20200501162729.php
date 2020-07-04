<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200501162729 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE fos_user ADD slug VARCHAR(50)');
        $this->addSql('ALTER TABLE fos_user ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql("UPDATE fos_user SET slug = REPLACE(LOWER(username), ' ', '-'), created_at = NOW()");
        $this->addSql('ALTER TABLE fos_user ALTER COLUMN slug SET NOT NULL');
        $this->addSql('ALTER TABLE fos_user ALTER COLUMN created_at SET NOT NULL');
        $this->addSql('ALTER TABLE fos_user ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479989D9B62 ON fos_user (slug)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UNIQ_957A6479989D9B62');
        $this->addSql('ALTER TABLE fos_user DROP slug');
        $this->addSql('ALTER TABLE fos_user DROP created_at');
        $this->addSql('ALTER TABLE fos_user DROP updated_at');
    }
}
