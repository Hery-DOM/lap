<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200513093125 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE owner_article (id INT AUTO_INCREMENT NOT NULL, owner_subcategory_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, text LONGTEXT DEFAULT NULL, published TINYINT(1) NOT NULL, picture VARCHAR(255) NOT NULL, picture_alt VARCHAR(255) DEFAULT NULL, INDEX IDX_8E4C88B919B966D2 (owner_subcategory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE owner_subcategory (id INT AUTO_INCREMENT NOT NULL, owner_category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, picto VARCHAR(255) NOT NULL, INDEX IDX_B387BCE14A24264 (owner_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE owner_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, picto VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE owner_article ADD CONSTRAINT FK_8E4C88B919B966D2 FOREIGN KEY (owner_subcategory_id) REFERENCES owner_subcategory (id)');
        $this->addSql('ALTER TABLE owner_subcategory ADD CONSTRAINT FK_B387BCE14A24264 FOREIGN KEY (owner_category_id) REFERENCES owner_category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE owner_article DROP FOREIGN KEY FK_8E4C88B919B966D2');
        $this->addSql('ALTER TABLE owner_subcategory DROP FOREIGN KEY FK_B387BCE14A24264');
        $this->addSql('DROP TABLE owner_article');
        $this->addSql('DROP TABLE owner_subcategory');
        $this->addSql('DROP TABLE owner_category');
    }
}
