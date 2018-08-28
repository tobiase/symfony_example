<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180802101538 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE stoff (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, beschreibung LONGTEXT DEFAULT NULL, preis DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stoff_customer (stoff_id INT NOT NULL, customer_id INT NOT NULL, INDEX IDX_4A56FDB9374736BD (stoff_id), INDEX IDX_4A56FDB99395C3F3 (customer_id), PRIMARY KEY(stoff_id, customer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stoff_customer ADD CONSTRAINT FK_4A56FDB9374736BD FOREIGN KEY (stoff_id) REFERENCES stoff (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stoff_customer ADD CONSTRAINT FK_4A56FDB99395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE stoff_customer DROP FOREIGN KEY FK_4A56FDB9374736BD');
        $this->addSql('DROP TABLE stoff');
        $this->addSql('DROP TABLE stoff_customer');
    }
}
