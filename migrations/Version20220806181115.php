<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220806181115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE reset_password_request_id_seq CASCADE');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('ALTER TABLE certification ALTER user_id SET NOT NULL');
        $this->addSql('ALTER TABLE education ALTER user_id SET NOT NULL');
        $this->addSql('ALTER TABLE education ALTER description DROP NOT NULL');
        $this->addSql('ALTER TABLE experience ALTER user_id SET NOT NULL');
        $this->addSql('ALTER TABLE experience ALTER description DROP NOT NULL');
        $this->addSql('ALTER TABLE skill ALTER user_id SET NOT NULL');
        $this->addSql('ALTER TABLE user_social_networking ALTER user_id SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE reset_password_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE reset_password_request (id INT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_7ce748aa76ed395 ON reset_password_request (user_id)');
        $this->addSql('COMMENT ON COLUMN reset_password_request.requested_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN reset_password_request.expires_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT fk_7ce748aa76ed395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_social_networking ALTER user_id DROP NOT NULL');
        $this->addSql('ALTER TABLE education ALTER user_id DROP NOT NULL');
        $this->addSql('ALTER TABLE education ALTER description SET NOT NULL');
        $this->addSql('ALTER TABLE certification ALTER user_id DROP NOT NULL');
        $this->addSql('ALTER TABLE experience ALTER user_id DROP NOT NULL');
        $this->addSql('ALTER TABLE experience ALTER description SET NOT NULL');
        $this->addSql('ALTER TABLE skill ALTER user_id DROP NOT NULL');
    }
}
