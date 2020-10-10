<?php

namespace App\DataFixtures;

use App\Entity\FoodProduct;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create();

        $products = ['Pommes', 'Poires', 'Gateaux', 'Poireaux', 'Petit salé', 'Bananes'];
        $condition = [true, false];

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setEmail($faker->email)
                ->setPhone($faker->e164PhoneNumber)
                ->setRoles(['ROLE_USER'])
                ->setPassword($this->encoder->encodePassword($user, 'password'));

            for ($j = 0; $j < 10; $j++) {
                $product = new FoodProduct();
                $product->setUser($user)
                    ->setCreatedAt(new \DateTime('now'))
                    ->setProductName($faker->randomElement($products))
                    ->setAvailable($faker->randomElement($condition))
                    ->setDescription($faker->sentence(25))
                    ->setExpiratedAt($faker->dateTimeBetween('-5Days', '+60Days'))
                    ->setLocation($faker->city);
                $manager->persist($product);
            }
            $manager->persist($user);
        }
        $manager->flush();
    }
}
