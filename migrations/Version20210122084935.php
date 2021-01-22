<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210122084935 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, rate_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_23A0E66BC999F9F (rate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_64C19C17294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rate (id INT AUTO_INCREMENT NOT NULL, note INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, rate_id INT DEFAULT NULL, pseudo VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_8D93D649BC999F9F (rate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_article (user_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_5A37106CA76ED395 (user_id), INDEX IDX_5A37106C7294869C (article_id), PRIMARY KEY(user_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66BC999F9F FOREIGN KEY (rate_id) REFERENCES rate (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C17294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649BC999F9F FOREIGN KEY (rate_id) REFERENCES rate (id)');
        $this->addSql('ALTER TABLE user_article ADD CONSTRAINT FK_5A37106CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_article ADD CONSTRAINT FK_5A37106C7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C17294869C');
        $this->addSql('ALTER TABLE user_article DROP FOREIGN KEY FK_5A37106C7294869C');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66BC999F9F');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649BC999F9F');
        $this->addSql('ALTER TABLE user_article DROP FOREIGN KEY FK_5A37106CA76ED395');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE rate');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_article');
    }
}
