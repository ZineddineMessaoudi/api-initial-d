<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231013183936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE character_job (character_id INT NOT NULL, job_id INT NOT NULL, INDEX IDX_B0723B661136BE75 (character_id), INDEX IDX_B0723B66BE04EA9 (job_id), PRIMARY KEY(character_id, job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_car (character_id INT NOT NULL, car_id INT NOT NULL, INDEX IDX_3C973D031136BE75 (character_id), INDEX IDX_3C973D03C3C6F69F (car_id), PRIMARY KEY(character_id, car_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE character_job ADD CONSTRAINT FK_B0723B661136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_job ADD CONSTRAINT FK_B0723B66BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_car ADD CONSTRAINT FK_3C973D031136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_car ADD CONSTRAINT FK_3C973D03C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE character_job DROP FOREIGN KEY FK_B0723B661136BE75');
        $this->addSql('ALTER TABLE character_job DROP FOREIGN KEY FK_B0723B66BE04EA9');
        $this->addSql('ALTER TABLE character_car DROP FOREIGN KEY FK_3C973D031136BE75');
        $this->addSql('ALTER TABLE character_car DROP FOREIGN KEY FK_3C973D03C3C6F69F');
        $this->addSql('DROP TABLE character_job');
        $this->addSql('DROP TABLE character_car');
    }
}
