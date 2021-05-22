<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210522150203 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458A76ED395');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458E00EE68D');
        $this->addSql('DROP INDEX IDX_D2294458A76ED395 ON feedback');
        $this->addSql('DROP INDEX IDX_D2294458E00EE68D ON feedback');
        $this->addSql('ALTER TABLE feedback DROP user_id, DROP id_product_id, CHANGE rating raiting SMALLINT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE feedback ADD user_id INT NOT NULL, ADD id_product_id INT DEFAULT NULL, CHANGE raiting rating SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458E00EE68D FOREIGN KEY (id_product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D2294458A76ED395 ON feedback (user_id)');
        $this->addSql('CREATE INDEX IDX_D2294458E00EE68D ON feedback (id_product_id)');
    }
}
