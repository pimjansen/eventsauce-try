<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230812131506 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql(
            '
            CREATE TABLE IF NOT EXISTS `user` (
                `user_id` BINARY(16) NOT NULL,
                `firstname` varchar(255) NULL,
                `lastname` varchar(255) NULL,
                `email` varchar(255) NOT NULL NULL,
                `created_at` DATETIME NOT NULL,
                PRIMARY KEY (`user_id` ASC)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE=InnoDB;
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE `user`");
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
