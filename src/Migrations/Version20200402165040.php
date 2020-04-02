<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200402165040 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE developer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(4) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE developer_task (developer_id INT NOT NULL, task_id INT NOT NULL, INDEX IDX_FAEA66664DD9267 (developer_id), INDEX IDX_FAEA6668DB60186 (task_id), PRIMARY KEY(developer_id, task_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, difficulty TINYINT(1) NOT NULL, duration SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE developer_task ADD CONSTRAINT FK_FAEA66664DD9267 FOREIGN KEY (developer_id) REFERENCES developer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE developer_task ADD CONSTRAINT FK_FAEA6668DB60186 FOREIGN KEY (task_id) REFERENCES task (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE developer_task DROP FOREIGN KEY FK_FAEA66664DD9267');
        $this->addSql('ALTER TABLE developer_task DROP FOREIGN KEY FK_FAEA6668DB60186');
        $this->addSql('DROP TABLE developer');
        $this->addSql('DROP TABLE developer_task');
        $this->addSql('DROP TABLE task');
    }
}
