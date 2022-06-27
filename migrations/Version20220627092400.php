<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220627092400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note_expense ADD note_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE note_expense ADD CONSTRAINT FK_AC9C493C44EA4809 FOREIGN KEY (note_type_id) REFERENCES note_type (id)');
        $this->addSql('CREATE INDEX IDX_AC9C493C44EA4809 ON note_expense (note_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note_expense DROP FOREIGN KEY FK_AC9C493C44EA4809');
        $this->addSql('DROP INDEX IDX_AC9C493C44EA4809 ON note_expense');
        $this->addSql('ALTER TABLE note_expense DROP note_type_id');
    }
}
