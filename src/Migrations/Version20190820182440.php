<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190820182440 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, street VARCHAR(255) NOT NULL, number INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE author (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE file (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, filename VARCHAR(255) NOT NULL, size INTEGER NOT NULL, description VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, format VARCHAR(255) DEFAULT NULL, duration INTEGER DEFAULT NULL, pages_number INTEGER DEFAULT NULL, orientation VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_8C9F3610F675F31B ON file (author_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, address_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F5B7AF75 ON user (address_id)');
        $this->addSql('CREATE TABLE user_user (user_source INTEGER NOT NULL, user_target INTEGER NOT NULL, PRIMARY KEY(user_source, user_target))');
        $this->addSql('CREATE INDEX IDX_F7129A803AD8644E ON user_user (user_source)');
        $this->addSql('CREATE INDEX IDX_F7129A80233D34C1 ON user_user (user_target)');
        $this->addSql('CREATE TABLE video (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, file VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_7CC7DA2CA76ED395 ON video (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_user');
        $this->addSql('DROP TABLE video');
    }
}
