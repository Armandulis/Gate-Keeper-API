<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240517143005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Added character and base_stats tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, base_stats_id INT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(50) DEFAULT "Void", experience DOUBLE PRECISION NOT NULL, currently_selected TINYINT(1) NOT NULL, backstory VARCHAR(10000) DEFAULT NULL, INDEX IDX_937AB034A76ED395 (user_id), UNIQUE INDEX UNIQ_937AB03470AA3482 (base_stats_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `base_stats` (id INT AUTO_INCREMENT NOT NULL, health DOUBLE PRECISION NOT NULL, defence DOUBLE PRECISION NOT NULL, mana DOUBLE PRECISION NOT NULL, damage DOUBLE PRECISION NOT NULL, luck DOUBLE PRECISION NOT NULL, critical_damage DOUBLE PRECISION NOT NULL, leach DOUBLE PRECISION NOT NULL, speed DOUBLE PRECISION NOT NULL, perception DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB03470AA3482 FOREIGN KEY (base_stats_id) REFERENCES base_stats (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034A76ED395');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB03470AA3482');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE `base_stats`');
    }
}
