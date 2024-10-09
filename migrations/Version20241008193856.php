<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241008193856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adiciona a coluna "situacao" na tabela "livro" e cria as tabelas de empréstimos e reservas.';
    }

    public function up(Schema $schema): void
    {
        // Cria as sequências para as tabelas de empréstimo e reserva
        $this->addSql('CREATE SEQUENCE emprestimo_id_emprestimo_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reserva_id_seq INCREMENT BY 1 MINVALUE 1 START 1');

        // Cria as tabelas de empréstimo e reserva
        $this->addSql('CREATE TABLE emprestimo (
        id_emprestimo INT NOT NULL,
        id_usuario INT NOT NULL,
        id_livro INT NOT NULL,
        data_emprestimo DATE NOT NULL,
        data_devolucao DATE NOT NULL,
        renovacoes INT NOT NULL,
        pendencias INT NOT NULL,
        PRIMARY KEY(id_emprestimo)
    )');

        $this->addSql('CREATE TABLE reserva (
        id INT NOT NULL,
        id_reserva INT NOT NULL,
        id_usuario INT NOT NULL,
        id_livro INT NOT NULL,
        data_reserva DATE NOT NULL,
        status_reserva VARCHAR(255) NOT NULL,
        PRIMARY KEY(id)
    )');

        // Adiciona a coluna "situacao" na tabela "livro" como NULLABLE
        $this->addSql('ALTER TABLE livro ADD situacao VARCHAR(255) DEFAULT NULL');

        // Atualiza a coluna "situacao" para todos os registros existentes
        $this->addSql('UPDATE livro SET situacao = \'disponível\' WHERE situacao IS NULL');

        // Altera a coluna "situacao" para NOT NULL
        $this->addSql('ALTER TABLE livro ALTER COLUMN situacao SET NOT NULL');

        // Altera as colunas na tabela "usuario"
        $this->addSql('ALTER TABLE usuario ALTER cpf TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE usuario ALTER telefone TYPE VARCHAR(20)'); // Alterar de INT para VARCHAR
    }


    public function down(Schema $schema): void
    {
        // Este método reverte as alterações feitas na migração
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE emprestimo_id_emprestimo_seq CASCADE');
        $this->addSql('DROP SEQUENCE reserva_id_seq CASCADE');
        $this->addSql('DROP TABLE emprestimo');
        $this->addSql('DROP TABLE reserva');
        $this->addSql('ALTER TABLE usuario ALTER cpf TYPE VARCHAR(11)');
        $this->addSql('ALTER TABLE usuario ALTER telefone TYPE BIGINT');
        $this->addSql('ALTER TABLE livro DROP situacao');
    }
}
