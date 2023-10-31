<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231023085515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE date_view (id INT AUTO_INCREMENT NOT NULL, data_id INT NOT NULL, dateforview DATE NOT NULL, INDEX IDX_DE23227A37F5A13C (data_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE date_view ADD CONSTRAINT FK_DE23227A37F5A13C FOREIGN KEY (data_id) REFERENCES companies (id)');
        $this->addSql('ALTER TABLE myview DROP FOREIGN KEY myview_ibfk_1');
        $this->addSql('DROP TABLE myview');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE myview (id INT DEFAULT NULL, idDate INT NOT NULL, Data DATE NOT NULL, INDEX id (id), PRIMARY KEY(idDate)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE myview ADD CONSTRAINT myview_ibfk_1 FOREIGN KEY (id) REFERENCES companies (id)');
        $this->addSql('ALTER TABLE date_view DROP FOREIGN KEY FK_DE23227A37F5A13C');
        $this->addSql('DROP TABLE date_view');
    }
}
