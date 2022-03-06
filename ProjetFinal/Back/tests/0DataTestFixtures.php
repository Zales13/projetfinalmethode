<?php
use App\DataFixtures\AppFixtures;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManagerInterface;

class DataFixturesTest extends KernelTestCase
{
    protected function setUp(): void {
        parent::setUp();
        exec("php bin/console doctrine:database:drop --env=test --force");
        exec("php bin/console doctrine:database:create --env=test");
        exec("php bin/console doctrine:migration:migrate -n --env=test");
    }
    public function testFixutres()
    {
        $appFixtures = self::getContainer()->get(AppFixtures::class);
        $objectManager = self::getContainer()->get(EntityManagerInterface::class);
        $appFixtures->load($objectManager);
        // tester si les fixtures sont bien load
        // faire le mock pour éviter l'appel à chaques fois

        $this->assertTrue(true);
    }
}