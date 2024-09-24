<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240924125917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE livro_id_livro_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE livro (id_livro INT NOT NULL, titulo VARCHAR(255) NOT NULL, autor VARCHAR(255) NOT NULL, edicao VARCHAR(100) NOT NULL, editora VARCHAR(255) NOT NULL, ano_publicacao DATE NOT NULL, cod_isbn INT NOT NULL, quantidade INT NOT NULL, setor VARCHAR(255) NOT NULL, PRIMARY KEY(id_livro))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4CB6A68782C67A91 ON livro (cod_isbn)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE livro_id_livro_seq CASCADE');
        $this->addSql('DROP TABLE livro');
    }
}
