<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201116122430 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE caisse (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(255) NOT NULL, solde NUMERIC(10, 0) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commission (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(255) NOT NULL, solde NUMERIC(10, 0) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dadj (id INT AUTO_INCREMENT NOT NULL, kourel_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_70E338BA706C4622 (kourel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE depense (id INT AUTO_INCREMENT NOT NULL, commission_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, montant SMALLINT NOT NULL, date DATETIME NOT NULL, INDEX IDX_34059757202D1EB2 (commission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diayante (id INT AUTO_INCREMENT NOT NULL, membre_id INT DEFAULT NULL, compte_id INT DEFAULT NULL, caisse_id INT DEFAULT NULL, eveneement_id INT DEFAULT NULL, montant SMALLINT NOT NULL, date DATETIME NOT NULL, INDEX IDX_AF9F79366A99F74A (membre_id), INDEX IDX_AF9F7936F2C56620 (compte_id), INDEX IDX_AF9F793627B4FEBF (caisse_id), INDEX IDX_AF9F79365E8A3E5F (eveneement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evennement (id INT AUTO_INCREMENT NOT NULL, typeeve_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_5C15C7748EA55A5D (typeeve_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hadiya (id INT AUTO_INCREMENT NOT NULL, membre_id INT DEFAULT NULL, caisse_id INT DEFAULT NULL, montant SMALLINT NOT NULL, date DATETIME NOT NULL, INDEX IDX_C63D71E36A99F74A (membre_id), INDEX IDX_C63D71E327B4FEBF (caisse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE khassida (id INT AUTO_INCREMENT NOT NULL, evennement_id INT DEFAULT NULL, dadji_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_28882756DCDFA082 (evennement_id), INDEX IDX_28882756838BB072 (dadji_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kourel (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lieu (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiel (id INT AUTO_INCREMENT NOT NULL, type_materiel_id INT DEFAULT NULL, commission_id INT DEFAULT NULL, numero VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_18D2B0915D91DD3E (type_materiel_id), INDEX IDX_18D2B091202D1EB2 (commission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, commission_id INT DEFAULT NULL, kourel_id INT DEFAULT NULL, matricule VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, age INT NOT NULL, INDEX IDX_F6B4FB29202D1EB2 (commission_id), INDEX IDX_F6B4FB29706C4622 (kourel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repetition (id INT AUTO_INCREMENT NOT NULL, kourel_id INT DEFAULT NULL, typere_id INT DEFAULT NULL, lieu_id INT DEFAULT NULL, heurdebut TIME NOT NULL, heurfin TIME NOT NULL, date DATETIME NOT NULL, INDEX IDX_9DB9AD52706C4622 (kourel_id), INDEX IDX_9DB9AD525AE2EAB2 (typere_id), INDEX IDX_9DB9AD526AB213CC (lieu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_user (role_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_332CA4DDD60322AC (role_id), INDEX IDX_332CA4DDA76ED395 (user_id), PRIMARY KEY(role_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_ev (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_materiel (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_repetition (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, membre_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6496A99F74A (membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dadj ADD CONSTRAINT FK_70E338BA706C4622 FOREIGN KEY (kourel_id) REFERENCES kourel (id)');
        $this->addSql('ALTER TABLE depense ADD CONSTRAINT FK_34059757202D1EB2 FOREIGN KEY (commission_id) REFERENCES commission (id)');
        $this->addSql('ALTER TABLE diayante ADD CONSTRAINT FK_AF9F79366A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE diayante ADD CONSTRAINT FK_AF9F7936F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE diayante ADD CONSTRAINT FK_AF9F793627B4FEBF FOREIGN KEY (caisse_id) REFERENCES caisse (id)');
        $this->addSql('ALTER TABLE diayante ADD CONSTRAINT FK_AF9F79365E8A3E5F FOREIGN KEY (eveneement_id) REFERENCES evennement (id)');
        $this->addSql('ALTER TABLE evennement ADD CONSTRAINT FK_5C15C7748EA55A5D FOREIGN KEY (typeeve_id) REFERENCES type_ev (id)');
        $this->addSql('ALTER TABLE hadiya ADD CONSTRAINT FK_C63D71E36A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE hadiya ADD CONSTRAINT FK_C63D71E327B4FEBF FOREIGN KEY (caisse_id) REFERENCES caisse (id)');
        $this->addSql('ALTER TABLE khassida ADD CONSTRAINT FK_28882756DCDFA082 FOREIGN KEY (evennement_id) REFERENCES evennement (id)');
        $this->addSql('ALTER TABLE khassida ADD CONSTRAINT FK_28882756838BB072 FOREIGN KEY (dadji_id) REFERENCES dadj (id)');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B0915D91DD3E FOREIGN KEY (type_materiel_id) REFERENCES type_materiel (id)');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B091202D1EB2 FOREIGN KEY (commission_id) REFERENCES commission (id)');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB29202D1EB2 FOREIGN KEY (commission_id) REFERENCES commission (id)');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB29706C4622 FOREIGN KEY (kourel_id) REFERENCES kourel (id)');
        $this->addSql('ALTER TABLE repetition ADD CONSTRAINT FK_9DB9AD52706C4622 FOREIGN KEY (kourel_id) REFERENCES kourel (id)');
        $this->addSql('ALTER TABLE repetition ADD CONSTRAINT FK_9DB9AD525AE2EAB2 FOREIGN KEY (typere_id) REFERENCES type_repetition (id)');
        $this->addSql('ALTER TABLE repetition ADD CONSTRAINT FK_9DB9AD526AB213CC FOREIGN KEY (lieu_id) REFERENCES lieu (id)');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE diayante DROP FOREIGN KEY FK_AF9F793627B4FEBF');
        $this->addSql('ALTER TABLE hadiya DROP FOREIGN KEY FK_C63D71E327B4FEBF');
        $this->addSql('ALTER TABLE depense DROP FOREIGN KEY FK_34059757202D1EB2');
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B091202D1EB2');
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB29202D1EB2');
        $this->addSql('ALTER TABLE diayante DROP FOREIGN KEY FK_AF9F7936F2C56620');
        $this->addSql('ALTER TABLE khassida DROP FOREIGN KEY FK_28882756838BB072');
        $this->addSql('ALTER TABLE diayante DROP FOREIGN KEY FK_AF9F79365E8A3E5F');
        $this->addSql('ALTER TABLE khassida DROP FOREIGN KEY FK_28882756DCDFA082');
        $this->addSql('ALTER TABLE dadj DROP FOREIGN KEY FK_70E338BA706C4622');
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB29706C4622');
        $this->addSql('ALTER TABLE repetition DROP FOREIGN KEY FK_9DB9AD52706C4622');
        $this->addSql('ALTER TABLE repetition DROP FOREIGN KEY FK_9DB9AD526AB213CC');
        $this->addSql('ALTER TABLE diayante DROP FOREIGN KEY FK_AF9F79366A99F74A');
        $this->addSql('ALTER TABLE hadiya DROP FOREIGN KEY FK_C63D71E36A99F74A');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496A99F74A');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDD60322AC');
        $this->addSql('ALTER TABLE evennement DROP FOREIGN KEY FK_5C15C7748EA55A5D');
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B0915D91DD3E');
        $this->addSql('ALTER TABLE repetition DROP FOREIGN KEY FK_9DB9AD525AE2EAB2');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDA76ED395');
        $this->addSql('DROP TABLE caisse');
        $this->addSql('DROP TABLE commission');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE dadj');
        $this->addSql('DROP TABLE depense');
        $this->addSql('DROP TABLE diayante');
        $this->addSql('DROP TABLE evennement');
        $this->addSql('DROP TABLE hadiya');
        $this->addSql('DROP TABLE khassida');
        $this->addSql('DROP TABLE kourel');
        $this->addSql('DROP TABLE lieu');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE repetition');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_user');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE type_ev');
        $this->addSql('DROP TABLE type_materiel');
        $this->addSql('DROP TABLE type_repetition');
        $this->addSql('DROP TABLE user');
    }
}
