<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210127133622 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rate ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F39A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DFEC3F39A76ED395 ON rate (user_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649BC999F9F');
        $this->addSql('DROP INDEX IDX_8D93D649BC999F9F ON user');
        $this->addSql('ALTER TABLE user DROP rate_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F39A76ED395');
        $this->addSql('DROP INDEX IDX_DFEC3F39A76ED395 ON rate');
        $this->addSql('ALTER TABLE rate DROP user_id');
        $this->addSql('ALTER TABLE user ADD rate_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BC999F9F FOREIGN KEY (rate_id) REFERENCES rate (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649BC999F9F ON user (rate_id)');
    }
}
