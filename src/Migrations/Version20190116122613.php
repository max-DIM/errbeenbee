<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190116122613 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE accommodation (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, surface INT NOT NULL, price_by_night DOUBLE PRECISION NOT NULL, active TINYINT(1) NOT NULL, capacity INT NOT NULL, accType VARCHAR(255) NOT NULL, INDEX IDX_2D3854127E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accommodation_equipment (accommodation_id INT NOT NULL, equipment_id INT NOT NULL, INDEX IDX_6A0325A58F3692CD (accommodation_id), INDEX IDX_6A0325A5517FE9FE (equipment_id), PRIMARY KEY(accommodation_id, equipment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE availability (id INT AUTO_INCREMENT NOT NULL, accommodation_id INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, INDEX IDX_3FB7A2BF8F3692CD (accommodation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, accommodation_id INT NOT NULL, traveller_id INT NOT NULL, feedback_id INT DEFAULT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, price DOUBLE PRECISION NOT NULL, validated TINYINT(1) NOT NULL, INDEX IDX_E00CEDDE8F3692CD (accommodation_id), INDEX IDX_E00CEDDEE58489A0 (traveller_id), UNIQUE INDEX UNIQ_E00CEDDED249A887 (feedback_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feedback (id INT AUTO_INCREMENT NOT NULL, stars INT NOT NULL, comment VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE house (id INT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, usrType VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE owner (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT NOT NULL, shared_room TINYINT(1) NOT NULL, shared_kitchen TINYINT(1) NOT NULL, shared_bathroom TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE traveller (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE accommodation ADD CONSTRAINT FK_2D3854127E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id)');
        $this->addSql('ALTER TABLE accommodation_equipment ADD CONSTRAINT FK_6A0325A58F3692CD FOREIGN KEY (accommodation_id) REFERENCES accommodation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE accommodation_equipment ADD CONSTRAINT FK_6A0325A5517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE availability ADD CONSTRAINT FK_3FB7A2BF8F3692CD FOREIGN KEY (accommodation_id) REFERENCES accommodation (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE8F3692CD FOREIGN KEY (accommodation_id) REFERENCES accommodation (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEE58489A0 FOREIGN KEY (traveller_id) REFERENCES traveller (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDED249A887 FOREIGN KEY (feedback_id) REFERENCES feedback (id)');
        $this->addSql('ALTER TABLE house ADD CONSTRAINT FK_67D5399DBF396750 FOREIGN KEY (id) REFERENCES accommodation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE owner ADD CONSTRAINT FK_CF60E67CBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519BBF396750 FOREIGN KEY (id) REFERENCES accommodation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE traveller ADD CONSTRAINT FK_92E7B427BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE accommodation_equipment DROP FOREIGN KEY FK_6A0325A58F3692CD');
        $this->addSql('ALTER TABLE availability DROP FOREIGN KEY FK_3FB7A2BF8F3692CD');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE8F3692CD');
        $this->addSql('ALTER TABLE house DROP FOREIGN KEY FK_67D5399DBF396750');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519BBF396750');
        $this->addSql('ALTER TABLE accommodation_equipment DROP FOREIGN KEY FK_6A0325A5517FE9FE');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDED249A887');
        $this->addSql('ALTER TABLE owner DROP FOREIGN KEY FK_CF60E67CBF396750');
        $this->addSql('ALTER TABLE traveller DROP FOREIGN KEY FK_92E7B427BF396750');
        $this->addSql('ALTER TABLE accommodation DROP FOREIGN KEY FK_2D3854127E3C61F9');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEE58489A0');
        $this->addSql('DROP TABLE accommodation');
        $this->addSql('DROP TABLE accommodation_equipment');
        $this->addSql('DROP TABLE availability');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE feedback');
        $this->addSql('DROP TABLE house');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE owner');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE traveller');
    }
}