<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160818171322 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE proyecto_rol (proyecto_id INT NOT NULL, rol_id INT NOT NULL, INDEX IDX_4EC328E7F625D1BA (proyecto_id), INDEX IDX_4EC328E74BAB96C (rol_id), PRIMARY KEY(proyecto_id, rol_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE proyecto_rol ADD CONSTRAINT FK_4EC328E7F625D1BA FOREIGN KEY (proyecto_id) REFERENCES Proyecto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE proyecto_rol ADD CONSTRAINT FK_4EC328E74BAB96C FOREIGN KEY (rol_id) REFERENCES Rol (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Proyecto DROP FOREIGN KEY FK_96A460EFDB38439E');
        $this->addSql('DROP INDEX IDX_96A460EFDB38439E ON Proyecto');
        $this->addSql('ALTER TABLE Proyecto DROP usuario_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE proyecto_rol');
        $this->addSql('ALTER TABLE Proyecto ADD usuario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Proyecto ADD CONSTRAINT FK_96A460EFDB38439E FOREIGN KEY (usuario_id) REFERENCES Usuario (id)');
        $this->addSql('CREATE INDEX IDX_96A460EFDB38439E ON Proyecto (usuario_id)');
    }
}
