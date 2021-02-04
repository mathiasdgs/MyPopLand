<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210204100815 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ma_collection_article (ma_collection_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_EC471ABC8D77594 (ma_collection_id), INDEX IDX_EC471ABC7294869C (article_id), PRIMARY KEY(ma_collection_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ma_collection_article ADD CONSTRAINT FK_EC471ABC8D77594 FOREIGN KEY (ma_collection_id) REFERENCES ma_collection (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ma_collection_article ADD CONSTRAINT FK_EC471ABC7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ma_collection ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ma_collection ADD CONSTRAINT FK_1DDF863A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1DDF863A76ED395 ON ma_collection (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ma_collection_article');
        $this->addSql('ALTER TABLE ma_collection DROP FOREIGN KEY FK_1DDF863A76ED395');
        $this->addSql('DROP INDEX UNIQ_1DDF863A76ED395 ON ma_collection');
        $this->addSql('ALTER TABLE ma_collection DROP user_id');
    }
}
