<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201114145440 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE reset_password_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE reset_password_request (id INT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
        $this->addSql('COMMENT ON COLUMN reset_password_request.requested_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN reset_password_request.expires_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP INDEX uniq_957a6479c05fb297');
        $this->addSql('DROP INDEX uniq_957a6479a0d96fbf');
        $this->addSql('DROP INDEX uniq_957a647992fc23a8');
        $this->addSql('ALTER TABLE fos_user DROP username');
        $this->addSql('ALTER TABLE fos_user DROP username_canonical');
        $this->addSql('ALTER TABLE fos_user DROP email_canonical');
        $this->addSql('ALTER TABLE fos_user DROP last_login');
        $this->addSql('ALTER TABLE fos_user DROP confirmation_token');
        $this->addSql('ALTER TABLE fos_user DROP password_requested_at');
        $this->addSql('ALTER TABLE fos_user ALTER email TYPE VARCHAR(200)');
        $this->addSql('ALTER TABLE fos_user ALTER roles TYPE JSON USING to_json(roles)');
        $this->addSql('ALTER TABLE fos_user ALTER roles DROP DEFAULT');
        $this->addSql('ALTER TABLE fos_user RENAME COLUMN enabled TO is_verified');
        $this->addSql('COMMENT ON COLUMN fos_user.roles IS NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE reset_password_request_id_seq CASCADE');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('ALTER TABLE fos_user ADD username VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE fos_user ADD username_canonical VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE fos_user ADD email_canonical VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE fos_user ADD last_login TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD confirmation_token VARCHAR(180) DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD password_requested_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ALTER email TYPE VARCHAR(180)');
        $this->addSql('ALTER TABLE fos_user ALTER roles TYPE TEXT');
        $this->addSql('ALTER TABLE fos_user ALTER roles DROP DEFAULT');
        $this->addSql('ALTER TABLE fos_user RENAME COLUMN is_verified TO enabled');
        $this->addSql('COMMENT ON COLUMN fos_user.roles IS \'(DC2Type:array)\'');
        $this->addSql('CREATE UNIQUE INDEX uniq_957a6479c05fb297 ON fos_user (confirmation_token)');
        $this->addSql('CREATE UNIQUE INDEX uniq_957a6479a0d96fbf ON fos_user (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX uniq_957a647992fc23a8 ON fos_user (username_canonical)');
    }
}
