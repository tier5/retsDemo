<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RetsController extends Controller
{
    //
    //date_default_timezone_set('America/New_York');

    public function index(){
      $rets_login_url = 'http://rets.las.mlsmatrix.com/rets/login.ashx';
      $rets_username  = 'neal';
      $rets_password  = 'glvar';

      $config = new \PHRETS\Configuration;
      $config->setLoginUrl($rets_login_url)
        ->setUsername($rets_username)
        ->setPassword($rets_password);
    $config->setRetsVersion('1.5');

    //   $rets_login_url = $rets_login_url;
    //     $rets_username = $rets_username;
    //     $rets_password = $rets_password;
    //     $rets = new \PHRETS();
    //     $rets->AddHeader("RETS-Version", "RETS/2.5");
    //     $connect = $rets->Connect($rets_login_url, $rets_username, $rets_password);
    //     dd($connect);
      // get a session ready using the configuration
      $rets = new \PHRETS\Session($config);

      $connect = $rets->Login(); //working
      //dd($connect);

    //   $fields = $rets->GetTableMetadata('Property', 'A');
    //   var_dump($fields[0]);
      $system = $rets->GetSystemMetadata(); //working
      //dd($system);

        $resources = $system->getResources(); //working
        //dd($resources);
        $classes = $resources->all(); // working
        //dd($classes);

        $classes = $rets->GetClassesMetadata('Property');
        //dd($classes);// working


          $results = $rets->Search('Property', 'A', '*', ['Limit' => 3, 'Select' => 'LIST_1,LIST_105,LIST_15,LIST_22,LIST_87,LIST_133,LIST_134']);
            foreach ($results as $r) {
                var_dump($r);
            } // :: GETS INVALID CLASS TYPE
        dd($results);


        //FROM THEIR DOCUMENTATION
        // :: GETS INVALID CLASS TYPE
        //URL : https://github.com/troydavisson/PHRETS/blob/master/docs/examples.md
        $timestamp_field = 'LIST_87';
        $property_classes = ['A', 'B', 'C'];

        foreach ($property_classes as $pc) {
            // generate the DMQL query
            $query = "({$timestamp_field}=2000-01-01T00:00:00+)";

            // make the request and get the results
            $results = $rets->Search('Property', $pc, $query);
            dd($results);
            // save the results in a local file
            file_put_contents('data/Property_' . $pc . '.csv', $results->toCSV());
        }

    //  $objects = $rets->GetObject('Property');
    //  dd($objects);
     //die();
    //
     //$fields = $rets->GetTableMetadata('Office', 'A');
    //dd($fields[0]);
    //$r = \PHRETS\Model($config);

        // $timestamp_field = 'LIST_87';
        // $property_classes = ['A', 'B', 'C'];
        //
        // foreach ($property_classes as $pc) {
        // // generate the DMQL query
        //         $query = "({$timestamp_field}=2000-01-01T00:00:00+)";
        //
        //         // make the request and get the results
        //         $results = $rets->Search('Agent', $pc, $query);
        //
        //         // save the results in a local file
        //         //file_put_contents('data/Property_' . $pc . '.csv', $results->toCSV());
        //         dd($results);
        // }



    //   $r = new \PHRETS;
    //   // make the first request
    //   $connect = $rets->Login();
      //
    //   $system = $rets->GetSystemMetadata();
      //
    //   echo "Server Name: " . $system->getSystemDescription();
      //
    //   dd($rets->GetMetadataResources());
      //
    //   $timestamp_field = 'LIST_87';
    //   $property_classes = ['A', 'B', 'C'];
      //
    //   foreach ($property_classes as $pc) {
    //     // generate the DMQL query
    //     $query = "(MetadataTimestamp=2009-05-17T18:21:53+)";
    //     //dd($query);
    //     // make the request and get the results
      //
    //     $search = $rets->SearchQuery("Property","ResidentialProperty","(ListDate=1990-01-01+)",array("StandardNames" => 1));
    //     dd($search);
    //     $results = $rets->Search('Property', $pc, $query);
    //     dd($results);
    //     // save the results in a local file
    //     file_put_contents('data/Property_' . $pc . '.csv', $results->toCSV());
    //   }
      //
    //   dd($connect);


    //require_once("vendor/autoload.php");
    // $config = new \PHRETS\Configuration;
    // $config->setLoginUrl('http://rets.las.mlsmatrix.com/rets/login.ashx')
    //     ->setUsername('neal')
    //     ->setPassword('glvar');
    // $rets = new \PHRETS\Session($config);
    // $connect = $rets->Login();
    // $results = $rets->Search('Property', 'A', '*', ['Limit' => 3, 'Select' => 'LIST_1,LIST_105,LIST_15,LIST_22,LIST_87,LIST_133,LIST_134']);
    // dd($results);



    }
}
