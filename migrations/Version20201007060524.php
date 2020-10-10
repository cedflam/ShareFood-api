<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201007060524 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chat (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE food_product (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, product_name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, expirated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, available TINYINT(1) NOT NULL, image_url VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, INDEX IDX_9CD5D895A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, food_product_id INT DEFAULT NULL, filename VARCHAR(255) DEFAULT NULL, INDEX IDX_C53D045F22C1D6FB (food_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, food_product_id INT DEFAULT NULL, chat_id INT DEFAULT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_B6BD307F22C1D6FB (food_product_id), INDEX IDX_B6BD307F1A9A7125 (chat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_chat (user_id INT NOT NULL, chat_id INT NOT NULL, INDEX IDX_1F1CBE63A76ED395 (user_id), INDEX IDX_1F1CBE631A9A7125 (chat_id), PRIMARY KEY(user_id, chat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE food_product ADD CONSTRAINT FK_9CD5D895A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F22C1D6FB FOREIGN KEY (food_product_id) REFERENCES food_product (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F22C1D6FB FOREIGN KEY (food_product_id) REFERENCES food_product (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F1A9A7125 FOREIGN KEY (chat_id) REFERENCES chat (id)');
        $this->addSql('ALTER TABLE user_chat ADD CONSTRAINT FK_1F1CBE63A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_chat ADD CONSTRAINT FK_1F1CBE631A9A7125 FOREIGN KEY (chat_id) REFERENCES chat (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F1A9A7125');
        $this->addSql('ALTER TABLE user_chat DROP FOREIGN KEY FK_1F1CBE631A9A7125');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F22C1D6FB');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F22C1D6FB');
        $this->addSql('ALTER TABLE food_product DROP FOREIGN KEY FK_9CD5D895A76ED395');
        $this->addSql('ALTER TABLE user_chat DROP FOREIGN KEY FK_1F1CBE63A76ED395');
        $this->addSql('DROP TABLE chat');
        $this->addSql('DROP TABLE food_product');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_chat');
    }
}
