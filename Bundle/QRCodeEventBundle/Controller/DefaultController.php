<?php

namespace Devscoop\Bundle\QRCodeEventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Devscoop\Bundle\QRCodeEventBundle\Libraries\QRcode;

class DefaultController extends Controller
{
    static $FOLDER = "temp";
    static $FOLDER_PERMS = 0755;

    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $fname = time().'.png';

        if(!is_dir(self::$FOLDER))
        {
            mkdir(self::$FOLDER);
            chmod(self::$FOLDER, self::$FOLDER_PERMS);
        }
        QRcode::png('Enter a token here', self::$FOLDER.'/'.$fname);
        return array("img" => $fname);
    }

    /**
     * @Route("/temp/{name}")
     * @Template()
     */
    public function getImageAction($name)
    {
        header("Content-type: image/png");
        $fpath = self::$FOLDER.'/'.$name;
        if(file_exists($fpath))
        {
            $contents = file_get_contents($fpath);
            echo $contents;
        }

        return;
    }

    /**
     * @Route("/validate/{token}")
     * @Template()
     */
    public function validateAction($token)
    {
        // do logic

        return array("message" => "validated");
    }


}
