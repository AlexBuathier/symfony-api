<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220627093252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note_expense ADD company_id INT NOT NULL');
        $this->addSql('ALTER TABLE note_expense ADD CONSTRAINT FK_AC9C493C979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_AC9C493C979B1AD6 ON note_expense (company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note_expense DROP FOREIGN KEY FK_AC9C493C979B1AD6');
        $this->addSql('DROP INDEX IDX_AC9C493C979B1AD6 ON note_expense');
        $this->addSql('ALTER TABLE note_expense DROP company_id');
    }
}
