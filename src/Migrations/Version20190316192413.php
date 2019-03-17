<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190316192413 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB620BCF5E72D');
        $this->addSql('ALTER TABLE sous_categorie DROP FOREIGN KEY FK_52743D7B5CBD743C');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD6349A41E180');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB620365BF48');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, route VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7D053A93727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93727ACA70 FOREIGN KEY (parent_id) REFERENCES menu (id)');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE rubrique');
        $this->addSql('DROP TABLE sous_categorie');
        $this->addSql('DROP INDEX IDX_140AB620BCF5E72D ON page');
        $this->addSql('DROP INDEX IDX_140AB620365BF48 ON page');
        $this->addSql('ALTER TABLE page DROP categorie_id, DROP sous_categorie_id');
        // $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93727ACA70');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, rubrique_parente_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, url VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_497DD6349A41E180 (rubrique_parente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE rubrique (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, onglet_parent VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, url VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sous_categorie (id INT AUTO_INCREMENT NOT NULL, categorie_parente_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, url VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_52743D7B5CBD743C (categorie_parente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD6349A41E180 FOREIGN KEY (rubrique_parente_id) REFERENCES rubrique (id)');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7B5CBD743C FOREIGN KEY (categorie_parente_id) REFERENCES categorie (id)');
        $this->addSql('DROP TABLE menu');
        $this->addSql('ALTER TABLE page ADD categorie_id INT DEFAULT NULL, ADD sous_categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB620365BF48 FOREIGN KEY (sous_categorie_id) REFERENCES sous_categorie (id)');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB620BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_140AB620BCF5E72D ON page (categorie_id)');
        $this->addSql('CREATE INDEX IDX_140AB620365BF48 ON page (sous_categorie_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles TEXT NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
