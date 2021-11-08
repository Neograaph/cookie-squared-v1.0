<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211108160123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cookie (id INT AUTO_INCREMENT NOT NULL, id_site_id INT NOT NULL, name VARCHAR(255) NOT NULL, category VARCHAR(255) DEFAULT NULL, duration VARCHAR(255) DEFAULT NULL, domain VARCHAR(255) DEFAULT NULL, path VARCHAR(255) DEFAULT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_8AE0BA662820BF36 (id_site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE custom (id INT AUTO_INCREMENT NOT NULL, id_site_id INT NOT NULL, title VARCHAR(255) NOT NULL, message VARCHAR(1000) NOT NULL, color VARCHAR(255) NOT NULL, refuse_button TINYINT(1) NOT NULL, layout INT NOT NULL, INDEX IDX_F584169B2820BF36 (id_site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, id_owner_id INT NOT NULL, url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', scan_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', cookie_list VARCHAR(9999) DEFAULT NULL, name VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, INDEX IDX_694309E42EE78D6C (id_owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, id_option INT DEFAULT 1 NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cookie ADD CONSTRAINT FK_8AE0BA662820BF36 FOREIGN KEY (id_site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE custom ADD CONSTRAINT FK_F584169B2820BF36 FOREIGN KEY (id_site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E42EE78D6C FOREIGN KEY (id_owner_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cookie DROP FOREIGN KEY FK_8AE0BA662820BF36');
        $this->addSql('ALTER TABLE custom DROP FOREIGN KEY FK_F584169B2820BF36');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E42EE78D6C');
        $this->addSql('DROP TABLE cookie');
        $this->addSql('DROP TABLE custom');
        $this->addSql('DROP TABLE site');
        $this->addSql('DROP TABLE user');
    }
}
