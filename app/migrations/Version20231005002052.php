<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231005002052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Inserting taxes.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO tax (id, country_id, value, tax_number) VALUES ' . $this->getTaxValues());
    }

    private function getTaxValues(): string
    {
        $countries = [
            [
                'country_id' => 1,
                'value' => 19,
                'tax_number' => 'DE123456789',
            ],
            [
                'country_id' => 2,
                'value' => 22,
                'tax_number' => 'IT12345678901',
            ],
            [
                'country_id' => 3,
                'value' => 24,
                'tax_number' => 'GR123456789',
            ],
            [
                'country_id' => 4,
                'value' => 20,
                'tax_number' => 'FRab123456789',
            ],
        ];

        $valuesArray = [];
        foreach ($countries as $key => $country) {
            $valuesArray[] = sprintf('(%u, \'%u\', \'%s\', \'%s\')', ++$key, $country['country_id'], $country['value'], $country['tax_number']);
        }

        return implode(',', $valuesArray);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
    }
}
