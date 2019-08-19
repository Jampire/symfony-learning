<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190818233325 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX UNIQ_8D93D649F5B7AF75');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, address_id, name FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, address_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_8D93D649F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user (id, address_id, name) SELECT id, address_id, name FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F5B7AF75 ON user (address_id)');
        $this->addSql('DROP INDEX IDX_F7129A80233D34C1');
        $this->addSql('DROP INDEX IDX_F7129A803AD8644E');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_user AS SELECT user_source, user_target FROM user_user');
        $this->addSql('DROP TABLE user_user');
        $this->addSql('CREATE TABLE user_user (user_source INTEGER NOT NULL, user_target INTEGER NOT NULL, PRIMARY KEY(user_source, user_target), CONSTRAINT FK_F7129A803AD8644E FOREIGN KEY (user_source) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F7129A80233D34C1 FOREIGN KEY (user_target) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user_user (user_source, user_target) SELECT user_source, user_target FROM __temp__user_user');
        $this->addSql('DROP TABLE __temp__user_user');
        $this->addSql('CREATE INDEX IDX_F7129A80233D34C1 ON user_user (user_target)');
        $this->addSql('CREATE INDEX IDX_F7129A803AD8644E ON user_user (user_source)');
        $this->addSql('DROP INDEX IDX_8C9F3610F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__file AS SELECT id, author_id, filename, size, description, type, format, duration, pages_number, orientation FROM file');
        $this->addSql('DROP TABLE file');
        $this->addSql('CREATE TABLE file (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, filename VARCHAR(255) NOT NULL COLLATE BINARY, size INTEGER NOT NULL, description VARCHAR(255) NOT NULL COLLATE BINARY, type VARCHAR(255) NOT NULL COLLATE BINARY, format VARCHAR(255) DEFAULT NULL COLLATE BINARY, duration INTEGER DEFAULT NULL, pages_number INTEGER DEFAULT NULL, orientation VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_8C9F3610F675F31B FOREIGN KEY (author_id) REFERENCES author (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO file (id, author_id, filename, size, description, type, format, duration, pages_number, orientation) SELECT id, author_id, filename, size, description, type, format, duration, pages_number, orientation FROM __temp__file');
        $this->addSql('DROP TABLE __temp__file');
        $this->addSql('CREATE INDEX IDX_8C9F3610F675F31B ON file (author_id)');
        $this->addSql('DROP INDEX IDX_7CC7DA2CA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__video AS SELECT id, user_id, title FROM video');
        $this->addSql('DROP TABLE video');
        $this->addSql('CREATE TABLE video (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL, CONSTRAINT FK_7CC7DA2CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO video (id, user_id, title) SELECT id, user_id, title FROM __temp__video');
        $this->addSql('DROP TABLE __temp__video');
        $this->addSql('CREATE INDEX IDX_7CC7DA2CA76ED395 ON video (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_8C9F3610F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__file AS SELECT id, author_id, filename, size, description, type, format, duration, pages_number, orientation FROM file');
        $this->addSql('DROP TABLE file');
        $this->addSql('CREATE TABLE file (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, filename VARCHAR(255) NOT NULL, size INTEGER NOT NULL, description VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, format VARCHAR(255) DEFAULT NULL, duration INTEGER DEFAULT NULL, pages_number INTEGER DEFAULT NULL, orientation VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO file (id, author_id, filename, size, description, type, format, duration, pages_number, orientation) SELECT id, author_id, filename, size, description, type, format, duration, pages_number, orientation FROM __temp__file');
        $this->addSql('DROP TABLE __temp__file');
        $this->addSql('CREATE INDEX IDX_8C9F3610F675F31B ON file (author_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649F5B7AF75');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, address_id, name FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, address_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, address_id, name) SELECT id, address_id, name FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F5B7AF75 ON user (address_id)');
        $this->addSql('DROP INDEX IDX_F7129A803AD8644E');
        $this->addSql('DROP INDEX IDX_F7129A80233D34C1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_user AS SELECT user_source, user_target FROM user_user');
        $this->addSql('DROP TABLE user_user');
        $this->addSql('CREATE TABLE user_user (user_source INTEGER NOT NULL, user_target INTEGER NOT NULL, PRIMARY KEY(user_source, user_target))');
        $this->addSql('INSERT INTO user_user (user_source, user_target) SELECT user_source, user_target FROM __temp__user_user');
        $this->addSql('DROP TABLE __temp__user_user');
        $this->addSql('CREATE INDEX IDX_F7129A803AD8644E ON user_user (user_source)');
        $this->addSql('CREATE INDEX IDX_F7129A80233D34C1 ON user_user (user_target)');
        $this->addSql('DROP INDEX IDX_7CC7DA2CA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__video AS SELECT id, user_id, title FROM video');
        $this->addSql('DROP TABLE video');
        $this->addSql('CREATE TABLE video (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO video (id, user_id, title) SELECT id, user_id, title FROM __temp__video');
        $this->addSql('DROP TABLE __temp__video');
        $this->addSql('CREATE INDEX IDX_7CC7DA2CA76ED395 ON video (user_id)');
    }
}
