<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210121145559 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe RENAME INDEX idx_d3924853a76ed395 TO IDX_DA88B137A76ED395');
        $this->addSql('ALTER TABLE step RENAME INDEX idx_43b9fe3c2e1a626f TO IDX_43B9FE3C59D8A214');
        $this->addSql('ALTER TABLE user ADD name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe RENAME INDEX idx_da88b137a76ed395 TO IDX_D3924853A76ED395');
        $this->addSql('ALTER TABLE step RENAME INDEX idx_43b9fe3c59d8a214 TO IDX_43B9FE3C2E1A626F');
        $this->addSql('ALTER TABLE user DROP name');
    }
}
