<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201209120948 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, id_discussion_id INT NOT NULL, commentaires LONGTEXT NOT NULL, date DATE NOT NULL, INDEX IDX_67F068BC79F37AE5 (id_user_id), INDEX IDX_67F068BCA4F60274 (id_discussion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discussion (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fighters (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, age VARCHAR(255) NOT NULL, poids VARCHAR(255) NOT NULL, taille VARCHAR(255) NOT NULL, allonge VARCHAR(255) NOT NULL, palmares VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, categorie LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', rang LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', sexe LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC79F37AE5 FOREIGN KEY (id_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA4F60274 FOREIGN KEY (id_discussion_id) REFERENCES discussion (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA4F60274');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC79F37AE5');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE discussion');
        $this->addSql('DROP TABLE fighters');
        $this->addSql('DROP TABLE `user`');
    }
}
