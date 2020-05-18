<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200515130014 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE blog_tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog_article ADD blog_tag_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog_article ADD CONSTRAINT FK_EECCB3E52F9DC6D0 FOREIGN KEY (blog_tag_id) REFERENCES blog_tag (id)');
        $this->addSql('CREATE INDEX IDX_EECCB3E52F9DC6D0 ON blog_article (blog_tag_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog_article DROP FOREIGN KEY FK_EECCB3E52F9DC6D0');
        $this->addSql('DROP TABLE blog_tag');
        $this->addSql('DROP INDEX IDX_EECCB3E52F9DC6D0 ON blog_article');
        $this->addSql('ALTER TABLE blog_article DROP blog_tag_id');
    }
}
