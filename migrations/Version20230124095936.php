<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124095936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE child_presence (child_id INT NOT NULL, presence_id INT NOT NULL, INDEX IDX_E370BA01DD62C21B (child_id), INDEX IDX_E370BA01F328FFC4 (presence_id), PRIMARY KEY(child_id, presence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE child_presence ADD CONSTRAINT FK_E370BA01DD62C21B FOREIGN KEY (child_id) REFERENCES child (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE child_presence ADD CONSTRAINT FK_E370BA01F328FFC4 FOREIGN KEY (presence_id) REFERENCES presence (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE child_presence DROP FOREIGN KEY FK_E370BA01DD62C21B');
        $this->addSql('ALTER TABLE child_presence DROP FOREIGN KEY FK_E370BA01F328FFC4');
        $this->addSql('DROP TABLE child_presence');
    }
}
