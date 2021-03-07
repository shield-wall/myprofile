<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201127205453 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479E7927C74 ON fos_user (email)');
        $this->addSql('ALTER TABLE user_language DROP CONSTRAINT fk_345695b59d86650f');
        $this->addSql('DROP INDEX idx_345695b59d86650f');
        $this->addSql('ALTER TABLE user_language RENAME COLUMN user_id_id TO user_id');
        $this->addSql('ALTER TABLE user_language ADD CONSTRAINT FK_345695B5A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_345695B5A76ED395 ON user_language (user_id)');
        $this->addSql('ALTER TABLE user_social_networking ALTER user_id DROP NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_social_networking ALTER user_id SET NOT NULL');
        $this->addSql('ALTER TABLE user_language DROP CONSTRAINT FK_345695B5A76ED395');
        $this->addSql('DROP INDEX IDX_345695B5A76ED395');
        $this->addSql('ALTER TABLE user_language RENAME COLUMN user_id TO user_id_id');
        $this->addSql('ALTER TABLE user_language ADD CONSTRAINT fk_345695b59d86650f FOREIGN KEY (user_id_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_345695b59d86650f ON user_language (user_id_id)');
        $this->addSql('DROP INDEX UNIQ_957A6479E7927C74');
    }
}
