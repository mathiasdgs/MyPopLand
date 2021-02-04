<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210204104340 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ma_collection_article DROP FOREIGN KEY FK_EC471ABC8D77594');
        $this->addSql('CREATE TABLE collection (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_FC4D6532A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collection_article (collection_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_56167CB7514956FD (collection_id), INDEX IDX_56167CB77294869C (article_id), PRIMARY KEY(collection_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE collection ADD CONSTRAINT FK_FC4D6532A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE collection_article ADD CONSTRAINT FK_56167CB7514956FD FOREIGN KEY (collection_id) REFERENCES collection (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE collection_article ADD CONSTRAINT FK_56167CB77294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE ma_collection');
        $this->addSql('DROP TABLE ma_collection_article');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collection_article DROP FOREIGN KEY FK_56167CB7514956FD');
        $this->addSql('CREATE TABLE ma_collection (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_1DDF863A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ma_collection_article (ma_collection_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_EC471ABC8D77594 (ma_collection_id), INDEX IDX_EC471ABC7294869C (article_id), PRIMARY KEY(ma_collection_id, article_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ma_collection ADD CONSTRAINT FK_1DDF863A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ma_collection_article ADD CONSTRAINT FK_EC471ABC7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ma_collection_article ADD CONSTRAINT FK_EC471ABC8D77594 FOREIGN KEY (ma_collection_id) REFERENCES ma_collection (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE collection');
        $this->addSql('DROP TABLE collection_article');
    }
}
