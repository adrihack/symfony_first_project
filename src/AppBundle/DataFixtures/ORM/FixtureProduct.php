<?php
/**
 * Created by PhpStorm.
 * User: adri
 * Date: 18/10/17
 * Time: 14:54
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class FixtureProduct extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setTitle('product '.$i);
            $product->setPrice(mt_rand(10, 100));
            $product->setDescription('description produit fixture');

            $manager->persist($product);
        }
        $manager->flush();
    }
}