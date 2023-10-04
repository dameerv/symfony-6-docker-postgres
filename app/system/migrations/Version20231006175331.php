<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231006175331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO coupon (id, code, type, value) VALUES ' . $this->getCouponsValues());
    }

    public function getCouponsValues(): string
    {
        $coupons = [
            [
                'code' => 'D1',
                'type' => 'fix',
                'value' => 5
            ],
            [
                'code' => 'D2',
                'type' => 'fix',
                'value' => 6
            ],
            [
                'code' => 'D15',
                'type' => 'fix',
                'value' => 6
            ],
            [
                'code' => 'D10',
                'type' => 'percent',
                'value' => 5
            ],
            [
                'code' => 'D20',
                'type' => 'percent',
                'value' => 20
            ],
        ];

        $valuesArray = [];
        foreach ($coupons as $key => $coupon) {
            $valuesArray[] = sprintf('(%u, \'%s\', \'%s\', %u)', ++$key, $coupon['code'], $coupon['type'], $coupon['value']);
        }

        return implode(',', $valuesArray);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
    }
}
