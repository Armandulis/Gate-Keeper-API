<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240528085007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stats_levels (id INT AUTO_INCREMENT NOT NULL, level INT NOT NULL, experience DOUBLE PRECISION NOT NULL, health_level INT NOT NULL, defence_level INT NOT NULL, mana_level INT NOT NULL, damage_level INT NOT NULL, luck_level INT NOT NULL, critical_damage_level INT NOT NULL, leach_level INT NOT NULL, speed_level INT NOT NULL, perception_level INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `character` ADD stats_levels_id INT NOT NULL, DROP experience, CHANGE type type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034A152F180 FOREIGN KEY (stats_levels_id) REFERENCES stats_levels (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_937AB034A152F180 ON `character` (stats_levels_id)');
        $this->addSql('ALTER TABLE `character` RENAME INDEX uniq_937ab03470aa3482 TO UNIQ_937AB0343A41977A');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034A152F180');
        $this->addSql('DROP TABLE stats_levels');
        $this->addSql('DROP INDEX UNIQ_937AB034A152F180 ON `character`');
        $this->addSql('ALTER TABLE `character` ADD experience DOUBLE PRECISION NOT NULL, DROP stats_levels_id, CHANGE type type VARCHAR(50) DEFAULT \'Void\'');
        $this->addSql('ALTER TABLE `character` RENAME INDEX uniq_937ab0343a41977a TO UNIQ_937AB03470AA3482');
    }
}
