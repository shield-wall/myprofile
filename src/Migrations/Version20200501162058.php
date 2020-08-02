<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200501162058 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE fos_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_social_networking_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE education_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_language_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE certification_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE social_networking_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE experience_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE skill_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE fos_user (id INT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled BOOLEAN NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, roles TEXT NOT NULL, first_name VARCHAR(50) DEFAULT NULL, last_name VARCHAR(50) DEFAULT NULL, headline TEXT DEFAULT NULL, role VARCHAR(50) DEFAULT NULL, phone VARCHAR(20) DEFAULT NULL, cell VARCHAR(20) DEFAULT NULL, photo VARCHAR(100) DEFAULT NULL, background VARCHAR(100) DEFAULT NULL, summary TEXT DEFAULT NULL, country VARCHAR(50) DEFAULT NULL, state VARCHAR(50) DEFAULT NULL, city VARCHAR(50) DEFAULT NULL, gender VARCHAR(6) DEFAULT NULL, birthday DATE DEFAULT NULL, key_words VARCHAR(200) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A647992FC23A8 ON fos_user (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479A0D96FBF ON fos_user (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479C05FB297 ON fos_user (confirmation_token)');
        $this->addSql('COMMENT ON COLUMN fos_user.roles IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE user_social_networking (id INT NOT NULL, user_id INT NOT NULL, social_networking_id INT NOT NULL, link VARCHAR(200) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F4F0DC27A76ED395 ON user_social_networking (user_id)');
        $this->addSql('CREATE INDEX IDX_F4F0DC2775523ED1 ON user_social_networking (social_networking_id)');
        $this->addSql('CREATE UNIQUE INDEX relations_idx ON user_social_networking (user_id, social_networking_id)');
        $this->addSql('CREATE TABLE education (id INT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(150) NOT NULL, institution VARCHAR(50) NOT NULL, description TEXT NOT NULL, period_start DATE NOT NULL, period_end DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DB0A5ED2A76ED395 ON education (user_id)');
        $this->addSql('CREATE TABLE user_language (id INT NOT NULL, user_id_id INT NOT NULL, name VARCHAR(50) NOT NULL, level VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_345695B59D86650F ON user_language (user_id_id)');
        $this->addSql('CREATE TABLE certification (id INT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, period_start DATE NOT NULL, period_end DATE DEFAULT NULL, institution VARCHAR(100) NOT NULL, link VARCHAR(500) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6C3C6D75A76ED395 ON certification (user_id)');
        $this->addSql('CREATE TABLE social_networking (id INT NOT NULL, name VARCHAR(50) NOT NULL, icon VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE experience (id INT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(150) NOT NULL, company VARCHAR(50) NOT NULL, description TEXT NOT NULL, period_start DATE NOT NULL, period_end DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_590C103A76ED395 ON experience (user_id)');
        $this->addSql('CREATE TABLE skill (id INT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, level_experience SMALLINT NOT NULL, priority SMALLINT DEFAULT NULL, status BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5E3DE477A76ED395 ON skill (user_id)');
        $this->addSql('ALTER TABLE user_social_networking ADD CONSTRAINT FK_F4F0DC27A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_social_networking ADD CONSTRAINT FK_F4F0DC2775523ED1 FOREIGN KEY (social_networking_id) REFERENCES social_networking (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED2A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_language ADD CONSTRAINT FK_345695B59D86650F FOREIGN KEY (user_id_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE certification ADD CONSTRAINT FK_6C3C6D75A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE477A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_social_networking DROP CONSTRAINT FK_F4F0DC27A76ED395');
        $this->addSql('ALTER TABLE education DROP CONSTRAINT FK_DB0A5ED2A76ED395');
        $this->addSql('ALTER TABLE user_language DROP CONSTRAINT FK_345695B59D86650F');
        $this->addSql('ALTER TABLE certification DROP CONSTRAINT FK_6C3C6D75A76ED395');
        $this->addSql('ALTER TABLE experience DROP CONSTRAINT FK_590C103A76ED395');
        $this->addSql('ALTER TABLE skill DROP CONSTRAINT FK_5E3DE477A76ED395');
        $this->addSql('ALTER TABLE user_social_networking DROP CONSTRAINT FK_F4F0DC2775523ED1');
        $this->addSql('DROP SEQUENCE fos_user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_social_networking_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE education_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_language_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE certification_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE social_networking_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE experience_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE skill_id_seq CASCADE');
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('DROP TABLE user_social_networking');
        $this->addSql('DROP TABLE education');
        $this->addSql('DROP TABLE user_language');
        $this->addSql('DROP TABLE certification');
        $this->addSql('DROP TABLE social_networking');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE skill');
    }
}
