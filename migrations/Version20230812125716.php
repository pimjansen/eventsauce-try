<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230812125716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initial setup eventstore';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            '
            CREATE TABLE IF NOT EXISTS `eventstore` (
                `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                `event_id` BINARY(16) NOT NULL,
                `aggregate_root_id` BINARY(16) NOT NULL,
                `version` int(20) unsigned NULL,
                `payload` varchar(16001) NOT NULL,
                PRIMARY KEY (`id` ASC),
                KEY `reconstitution` (`aggregate_root_id`, `version` ASC)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE=InnoDB;
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE eventstore");

    }
}
