<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221229134442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biens ADD category_id INT NOT NULL, ADD titre VARCHAR(200) NOT NULL, ADD surface VARCHAR(100) NOT NULL, ADD etat VARCHAR(50) NOT NULL, ADD descriptif LONGTEXT NOT NULL, ADD prix DOUBLE PRECISION NOT NULL, ADD slug VARCHAR(255) NOT NULL, ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE biens ADD CONSTRAINT FK_1F9004DD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_1F9004DD12469DE2 ON biens (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biens DROP FOREIGN KEY FK_1F9004DD12469DE2');
        $this->addSql('DROP INDEX IDX_1F9004DD12469DE2 ON biens');
        $this->addSql('ALTER TABLE biens DROP category_id, DROP titre, DROP surface, DROP etat, DROP descriptif, DROP prix, DROP slug, DROP image');
    }
}
