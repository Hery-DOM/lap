<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200427083800 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE criteria (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, criteria_option VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE main_criteria (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE program_picture (id INT AUTO_INCREMENT NOT NULL, picture VARCHAR(255) NOT NULL, picture_alt VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE program (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, description_more LONGTEXT DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, postcode INT DEFAULT NULL, region VARCHAR(255) DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, typologie VARCHAR(255) DEFAULT NULL, number_rooms INT DEFAULT NULL, surface DOUBLE PRECISION DEFAULT NULL, movie VARCHAR(255) DEFAULT NULL, date_delivery DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE program_main_criteria (program_id INT NOT NULL, main_criteria_id INT NOT NULL, INDEX IDX_CA749A6C3EB8070A (program_id), INDEX IDX_CA749A6C4D882283 (main_criteria_id), PRIMARY KEY(program_id, main_criteria_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE program_criteria (program_id INT NOT NULL, criteria_id INT NOT NULL, INDEX IDX_372A67B43EB8070A (program_id), INDEX IDX_372A67B4990BEA15 (criteria_id), PRIMARY KEY(program_id, criteria_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE program_main_criteria ADD CONSTRAINT FK_CA749A6C3EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program_main_criteria ADD CONSTRAINT FK_CA749A6C4D882283 FOREIGN KEY (main_criteria_id) REFERENCES main_criteria (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program_criteria ADD CONSTRAINT FK_372A67B43EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program_criteria ADD CONSTRAINT FK_372A67B4990BEA15 FOREIGN KEY (criteria_id) REFERENCES criteria (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE program_criteria DROP FOREIGN KEY FK_372A67B4990BEA15');
        $this->addSql('ALTER TABLE program_main_criteria DROP FOREIGN KEY FK_CA749A6C4D882283');
        $this->addSql('ALTER TABLE program_main_criteria DROP FOREIGN KEY FK_CA749A6C3EB8070A');
        $this->addSql('ALTER TABLE program_criteria DROP FOREIGN KEY FK_372A67B43EB8070A');
        $this->addSql('DROP TABLE criteria');
        $this->addSql('DROP TABLE main_criteria');
        $this->addSql('DROP TABLE program_picture');
        $this->addSql('DROP TABLE program');
        $this->addSql('DROP TABLE program_main_criteria');
        $this->addSql('DROP TABLE program_criteria');
    }
}
