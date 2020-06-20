<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200620144307 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->skipIf(
            false === $schema->hasTable('migration_versions'),
            'Migration table was deleted.'
        );

        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE migration_versions');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE migration_versions (version VARCHAR(14) NOT NULL, executed_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(version))');
        $this->addSql('COMMENT ON COLUMN migration_versions.executed_at IS \'(DC2Type:datetime_immutable)\'');
    }
}
