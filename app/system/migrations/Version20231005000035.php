<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20231005000035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insert countries';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO country (id, name, code, tax_format) VALUES ' . $this->getCountryValues());
    }

    private function getCountryValues(): string
    {
        $countries = [
            ['Germany', 'DE', 'DEXXXXXXXXX'],
            ['Italy', 'IT', 'ITXXXXXXXXXXX'],
            ['Greece', 'GR', 'GRXXXXXXXXX'],
            ['France', 'FR', 'FRYYXXXXXXXXX'],
        ];

        $valuesArray = [];
        foreach ($countries as $key => $country) {
            $valuesArray[] = sprintf('(%u, \'%s\', \'%s\', \'%s\')', ++$key, $country[0], $country[1], $country[2]);
        }

        return implode(',', $valuesArray);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
    }
}
