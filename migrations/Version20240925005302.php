<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240925005302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE bibliotecario_id_bibliotecario_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cliente_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE livro_id_livro_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE usuario_id_usuario_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE bibliotecario (id_bibliotecario INT NOT NULL, data_admissao DATE NOT NULL, login VARCHAR(255) NOT NULL, senha VARCHAR(255) NOT NULL, PRIMARY KEY(id_bibliotecario))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CD19D6D2AA08CB10 ON bibliotecario (login)');
        $this->addSql('CREATE TABLE cliente (id INT NOT NULL, id_cliente INT NOT NULL, telefone_referencia INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE livro (id_livro INT NOT NULL, titulo VARCHAR(255) NOT NULL, autor VARCHAR(255) NOT NULL, edicao VARCHAR(100) NOT NULL, editora VARCHAR(255) NOT NULL, ano_publicacao INT NOT NULL, cod_isbn VARCHAR(255) NOT NULL, quantidade INT NOT NULL, setor VARCHAR(255) NOT NULL, PRIMARY KEY(id_livro))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4CB6A68782C67A91 ON livro (cod_isbn)');
        $this->addSql('CREATE TABLE usuario (id_usuario INT NOT NULL, nome VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, senha VARCHAR(255) NOT NULL, cpf INT NOT NULL, cidade VARCHAR(255) NOT NULL, estado VARCHAR(255) NOT NULL, logradouro VARCHAR(255) NOT NULL, bairro VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, cep INT NOT NULL, tipo VARCHAR(13) NOT NULL, telefone INT NOT NULL, PRIMARY KEY(id_usuario))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05DE7927C74 ON usuario (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05D3E3E11F0 ON usuario (cpf)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE bibliotecario_id_bibliotecario_seq CASCADE');
        $this->addSql('DROP SEQUENCE cliente_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE livro_id_livro_seq CASCADE');
        $this->addSql('DROP SEQUENCE usuario_id_usuario_seq CASCADE');
        $this->addSql('DROP TABLE bibliotecario');
        $this->addSql('DROP TABLE cliente');
        $this->addSql('DROP TABLE livro');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
