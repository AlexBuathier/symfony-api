<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220627093350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note_expense ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE note_expense ADD CONSTRAINT FK_AC9C493CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_AC9C493CA76ED395 ON note_expense (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note_expense DROP FOREIGN KEY FK_AC9C493CA76ED395');
        $this->addSql('DROP INDEX IDX_AC9C493CA76ED395 ON note_expense');
        $this->addSql('ALTER TABLE note_expense DROP user_id');
    }
}
