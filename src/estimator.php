<?php

class Input{
 

  public $region = array("name"=>"Africa", "avgAge"=>19.7, "avgDailyIncomeInUSD"=>5, "avgDailyIncomePopulation"=>0.71);
 
  public $periodType= "days";
  public $timeToElapse= 58;
  public $reportedCases= 674;
  public $population= 66622705;
  public $totalHospitalBeds= 1380614;
}
class Impact{
  public $currentlyInfected;
  public $infectionsByRequestedTime;
  public $severeCasesByRequestedTime;
  public $hospitalBedsByRequestedTime;
  public $casesForICUByRequestedTime;
  public $casesForVentilatorsByRequestedTime;
  public $dollarsInFlight;

}

class SevereImpact{
  public $currentlyInfected;
  public $infectionsByRequestedTime;
  public $severeCasesByRequestedTime;
  public $hospitalBedsByRequestedTime;
  public $casesForICUByRequestedTime;
  public $casesForVentilatorsByRequestedTime;
  public $dollarsInFlight;
}
class Output{
  public $data;
  public $impact;
  public $severeImpact;
}

$data= new Input();
$impact=new Impact();
$severeImpact=new SevereImpact();

function periodType($data)
{
  switch ($data->periodType) {
    case "days":
        return $data->timeToElapse;
    break;
    case "weeks":
        return intdiv($data->timeToElapse, 7);
    break;
    case "months":
        return intdiv($data->timeToElapse, 30);
    break;
}
}

function covid19ImpactEstimator($data)
{
  $impact->currentlyInfected=$data->reportedCases*10;

  $severeImpact->currentlyInfected=$data->reportedCases*50;

  $impact->infectionsByRequestedTime=$impact->currentlyInfected*pow(2,periodType($data));

  $severeImpact->infectionsByRequestedTime=$severeImpact->currentlyInfected*pow(2,periodType($data));

  $impact->severeCasesByRequestedTime=$impact->infectionsByRequestedTime*0.15;

  $severeImpact->severeCasesByRequestedTime=$severeImpact->infectionsByRequestedTime*0.15;
  $impact->hospitalBedsByRequestedTime=$data->totalHospitalBeds*0.35;
  $severeImpact->hospitalBedsByRequestedTime=$data->totalHospitalBeds*0.35;
  $impact->casesForICUByRequestedTime=$impact->infectionsByRequestedTime*0.05;
  $severeImpact->casesForICUByRequestedTime=$impact->infectionsByRequestedTime*0.05;
  $impact->casesForVentilatorsByRequestedTime=$impact->infectionsByRequestedTime*0.02;
  $severeImpact->casesForVentilatorsByRequestedTime=$impact->infectionsByRequestedTime*0.02;

  $impact->dollarsInFlight=$impact->infectionsByRequestedTime*0.65*1.5*30;
  $severeImpact->dollarsInFlight=$severeImpact->infectionsByRequestedTime*0.65*1.5*30;

  $newoutput= new Output();
  $newoutput->data=$data;
  $newoutput->impact=$impact;
  $newoutput->severeImpact=$severeImpact;
  // die(var_dump($newoutput->severeImpact->currentlyInfected));


  // echo $newoutput->impact->currentlyInfected ;
  // echo "$newoutput->severeImpact->currentlyInfected";
  // echo "$newoutput->impact->severeCasesByRequestedTime <br>";
  // echo "$newoutput->severeImpact->severeCasesByRequestedTime <br>";
  // echo "$newoutput->impact->hospitalBedsByRequestedTime <br>";
  // echo "$newoutput->impact->dollarsInFlight <br>";
  return $newoutput;
}

covid19ImpactEstimator($data);
// echo "$newoutput->impact->currentlyInfected <br>";
?>