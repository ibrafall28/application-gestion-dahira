<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201126114141 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE diayante (id INT AUTO_INCREMENT NOT NULL, membre_id INT DEFAULT NULL, caisse_id INT DEFAULT NULL, eveneement_id INT DEFAULT NULL, montant SMALLINT NOT NULL, date DATETIME NOT NULL, INDEX IDX_AF9F79366A99F74A (membre_id), INDEX IDX_AF9F793627B4FEBF (caisse_id), INDEX IDX_AF9F79365E8A3E5F (eveneement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE diayante ADD CONSTRAINT FK_AF9F79366A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE diayante ADD CONSTRAINT FK_AF9F793627B4FEBF FOREIGN KEY (caisse_id) REFERENCES caisse (id)');
        $this->addSql('ALTER TABLE diayante ADD CONSTRAINT FK_AF9F79365E8A3E5F FOREIGN KEY (eveneement_id) REFERENCES evennement (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE diayante');
    }
}
