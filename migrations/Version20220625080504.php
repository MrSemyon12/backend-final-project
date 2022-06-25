<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220625080504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favourite (id INT AUTO_INCREMENT NOT NULL, film_id_id INT NOT NULL, user_username_id INT NOT NULL, INDEX IDX_62A2CA19E6286007 (film_id_id), INDEX IDX_62A2CA19446DA9FD (user_username_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film (id INT AUTO_INCREMENT NOT NULL, category_name_id INT NOT NULL, title VARCHAR(40) NOT NULL, imageurl VARCHAR(255) DEFAULT NULL, INDEX IDX_8244BE22B6CFDCA8 (category_name_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favourite ADD CONSTRAINT FK_62A2CA19E6286007 FOREIGN KEY (film_id_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE favourite ADD CONSTRAINT FK_62A2CA19446DA9FD FOREIGN KEY (user_username_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE22B6CFDCA8 FOREIGN KEY (category_name_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE22B6CFDCA8');
        $this->addSql('ALTER TABLE favourite DROP FOREIGN KEY FK_62A2CA19E6286007');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE favourite');
        $this->addSql('DROP TABLE film');
    }
}
