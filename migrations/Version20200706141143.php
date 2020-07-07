<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200706141143 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_C509E4FF8CDE5729 ON chambre');
        $this->addSql('DROP INDEX UNIQ_C509E4FF2CE9E9CA ON chambre');
        $this->addSql('ALTER TABLE chambre CHANGE num_chambre num_chambre VARCHAR(30) NOT NULL, CHANGE num_batiment num_batiment VARCHAR(30) NOT NULL, CHANGE type type VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambre CHANGE num_chambre num_chambre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE num_batiment num_batiment VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C509E4FF8CDE5729 ON chambre (type)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C509E4FF2CE9E9CA ON chambre (num_batiment)');
    }
}
