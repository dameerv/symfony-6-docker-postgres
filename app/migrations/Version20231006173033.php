<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231006173033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO product (id, name, price) VALUES ' . $this->getProductValues());
    }

    public function getProductValues(): string
    {
        $products = [
            [
                'name' => 'Iphone',
                'price' => 100
            ],
            [
                'name' => 'Headphones',
                'price' => 20,
            ],
            [
                'name' => 'case',
                'price' => 10
            ]
        ];

        $valuesArray = [];
        foreach ($products as $key => $product) {
            $valuesArray[] = sprintf('(%u, \'%s\', \'%s\')', ++$key, $product['name'], $product['price']);
        }

        return implode(',', $valuesArray);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
    }
}
