<?php

namespace NeoNasaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;

use NeoNasaBundle\Document\Neorepo;

class DefaultController extends Controller
{

    public function indexAction()
    {
        $tab = array(
            "hello" => "world!"
        );
        $aff = json_encode($tab);
        return $this->render('NeoNasaBundle:Default:index.html.twig', array (
                'affichage' => $aff
            ));
    }
    
    public function addAction()
    {
        $data = file_get_contents('https://api.nasa.gov/neo/rest/v1/feed?start_date=2016-08-25&end_date=2016-08-28&detailed=true&api_key=N7LkblDsc5aen05FJqBQ8wU4qSdmsftwJagVK7UD', 'r');
        $tab = json_decode($data, true);
        foreach($tab['near_earth_objects'] as $date => $value) {
            foreach($value as $near_earth_object) {
                $neo_reference_id                   = $near_earth_object["neo_reference_id"];
                $nom                                = $near_earth_object["name"];
                $is_potentially_hazardous_asteroid  = $near_earth_object["is_potentially_hazardous_asteroid"];
                $kilometres_per_hours               = $near_earth_object["close_approach_data"][0]["relative_velocity"]["kilometers_per_hour"];
                $repo = new Neorepo();
                $repo->setDate($date);
                $repo->setReference($neo_reference_id);
                $repo->setNom($nom);
                $repo->setHazardous($is_potentially_hazardous_asteroid);
                $repo->setSpeed($kilometres_per_hours);
                $dm = $this->get('doctrine_mongodb')->getManager();
                try {
                    $dm->persist($repo);
                    $dm->flush();
                } catch (Exception $e) {
                    return new Response('Error occured');
                } 
            }
        }
        return new Response('Insert OK'); 
    }
    public function hazardousAction () 
        {
            $repository = $this->get('doctrine_mongodb')
                ->getManager()
                ->getRepository('NeoNasaBundle:Neorepo');
            
            $aff = $repository->findByHazardous(true);
        
            $arrayCollection = array();
            foreach($aff as $item) {
                $arrayCollection[] = array(
                    'id'        => $item->getId(),
                    'date'      => $item->getDate(),
                    'reference' => $item->getReference(),
                    'nom'       => $item->getNom(),
                    'hazardous' => $item->getHazardous(),
                    'speed'     => $item->getSpeed()
                );
            }
            
            return new JsonResponse(array('result' => $arrayCollection));
        }
    
     public function fastestAction () 
        {
            $repository = $this->get('doctrine_mongodb')
                ->getManager()
                ->createQueryBuilder('NeoNasaBundle:Neorepo')
                ->sort('speed', 'desc')
                ->getQuery()
                ->execute();
         
            $arrayCollection = array();
            foreach($repository as $item) {
                $arrayCollection[] = array(
                    'id'        => $item->getId(),
                    'date'      => $item->getDate(),
                    'reference' => $item->getReference(),
                    'nom'       => $item->getNom(),
                    'hazardous' => $item->getHazardous(),
                    'speed'     => $item->getSpeed()
                );
            }
            return new JsonResponse(array('result' => $arrayCollection));
        }
        
}
