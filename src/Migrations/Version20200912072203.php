<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200912072203 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE program_property DROP surface_min, DROP surface_max, DROP room_min, DROP room_max');
        $this->addSql('ALTER TABLE program ADD number_rooms_max INT DEFAULT NULL, ADD surface_min DOUBLE PRECISION DEFAULT NULL, ADD surface_max DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE program DROP number_rooms_max, DROP surface_min, DROP surface_max');
        $this->addSql('ALTER TABLE program_property ADD surface_min DOUBLE PRECISION DEFAULT NULL, ADD surface_max DOUBLE PRECISION DEFAULT NULL, ADD room_min INT DEFAULT NULL, ADD room_max INT DEFAULT NULL');
    }
}
