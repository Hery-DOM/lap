<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200607083333 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED7784469A7B');
        $this->addSql('DROP INDEX IDX_92ED7784469A7B ON program');
        $this->addSql('ALTER TABLE program DROP city, CHANGE program_city_id city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED77848BAC62AF FOREIGN KEY (city_id) REFERENCES program_city (id)');
        $this->addSql('CREATE INDEX IDX_92ED77848BAC62AF ON program (city_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED77848BAC62AF');
        $this->addSql('DROP INDEX IDX_92ED77848BAC62AF ON program');
        $this->addSql('ALTER TABLE program ADD city VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE city_id program_city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784469A7B FOREIGN KEY (program_city_id) REFERENCES program_city (id)');
        $this->addSql('CREATE INDEX IDX_92ED7784469A7B ON program (program_city_id)');
    }
}
