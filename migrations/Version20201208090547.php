<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201208090547 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, id_discussion_id INT NOT NULL, commentaires LONGTEXT NOT NULL, date DATE NOT NULL, INDEX IDX_67F068BC79F37AE5 (id_user_id), INDEX IDX_67F068BCA4F60274 (id_discussion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC79F37AE5 FOREIGN KEY (id_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA4F60274 FOREIGN KEY (id_discussion_id) REFERENCES discussion (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commentaire');
    }
}
