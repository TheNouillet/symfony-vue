<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixtures extends Fixture
{
    /**
     * Chargement initial des commentaires
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        // On récupère le nombre de produit
        $productCount = $manager->getRepository("AppBundle:Product")->getCount();

        for ($i = 0; $i < 200; $i++) {
            $comment = new Comment();
            $comment->setAuthor("Author " . $i);
            $comment->setContent("Content " . $i);

            // On assigne un produit /!\ instable
            $product = $manager->getRepository("AppBundle:Product")->find(mt_rand(1, $productCount));
            $comment->setProduct($product);

            $manager->persist($comment);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(ProductFixtures::class);
    }
}