<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Secteur;
use App\Entity\Annonces;
use App\Entity\Commentaires;
use App\Entity\Cryptomonaie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

        private $passwordEncoder;

        public function __construct(UserPasswordEncoderInterface $passwordEncoder)
        {
            $this->passwordEncoder = $passwordEncoder;
        }

    public function load(ObjectManager $manager): void
    {

        $user= new User();
        $user->setEmail("test@gmail.com")
        ->setRoles(["ROLE_USER"])
        ->setPassword($this->passwordEncoder->encodePassword(
        $user, 'test'
         ));
        $faker = Faker\Factory::create('FR-fr');
        //je vais créer 4 secteur fakés
        for ($i=1;$i<=4;$i++){
            $sector=new Secteur();
            $sector->setNom($faker->sentence())
                    ->setDescription($faker->paragraph());
                    $manager->persist($sector);
            $crypto =new Cryptomonaie();
            $crypto->setNom($faker->sentence())
                    ->setPrix($i); // TO DO : modifier type prix
                     
                    $manager->persist($crypto);

         
            // creation entre 5 et 6 Annonces
            for ($j=1;$j<=mt_rand(4,6);$j++){

                $article=new Annonces();
                $content ='<p>' .join($faker->paragraphs(5),'</p><p>' . '</p>');
              
                $article ->setTitre($faker->sentence())
                        ->setContenu($content)
                        ->setImage($faker->imageUrl())
                        ->setCreateAt($faker->dateTimeBetween('-5 months'))
                        ->setCrypto($crypto)
                        ->setAuteur($user)
                        ->setSecteur($sector);
                        $manager->persist($article);
          //generation des commentaires

              for ($k=0; $k <=mt_rand(4,5); $k++) { 
                   $comment = new Commentaires();
                   $content ='<p>' .join($faker->paragraphs(5),'</p><p>' ). '</p>';
                   $now=new \DateTime();
                   $interval=$now->diff($article->getCreateAt());
                   $days=$interval->days;
                   $min='-' .$days . 'days'; //-100 days
                   $comment ->setAuteur($user)
                            ->setContenus($content)
                            ->setCreatAt($faker->dateTimeBetween($min))
                            ->setUpdateAt($faker->dateTimeBetween('-100 days'))
                            ->setAnnonce($article);
                           
                            $manager->persist($comment);
                }
                
           

            }
           
        }
        $manager->flush();
    }
}