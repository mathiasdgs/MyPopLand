<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Symfony\Component\Asset\Package;


class AppExtension extends AbstractExtension
{
private $package;
   

    public function getFilters()
    {
        return [
            new TwigFilter('url', [$this, 'urlhttp']),
        ];
    

    }
    public function urlhttp(string $path){
      if(  strpos ( $path ,  "https://" ) === false){
          return "/images/".$path;

      }else{
          return $path;
      }
    }

}


