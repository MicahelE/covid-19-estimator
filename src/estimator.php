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
$data= new Input();
$impact=new Impact();
$severeImpact=new SevereImpact();

function covid19ImpactEstimator($data)
{
  $impact->currentlyInfected=$data->reportedCases*10;

  $severeImpact->currentlyInfected=$data->reportedCases*50;

  $impact->infectionsByRequestedTime=$impact->currentlyInfected*pow(2,9);

  $severeImpact->infectionsByRequestedTime=$severeImpact->currentlyInfected*pow(2,9);

  $impact->severeCasesByRequestedTime=$impact->infectionsByRequestedTime*0.15;

  $severeImpact->severeCasesByRequestedTime=$severeImpact->infectionsByRequestedTime*0.15;
  $impact->hospitalBedsByRequestedTime=$data->totalHospitalBeds*0.35;
  $severeImpact->hospitalBedsByRequestedTime=$data->totalHospitalBeds*0.35;
  $impact->casesForICUByRequestedTime=$impact->infectionsByRequestedTime*0.05;
  $severeImpact->casesForICUByRequestedTime=$impact->infectionsByRequestedTime*0.05;
  $impact->casesForVentilatorsByRequestedTime=$impact->infectionsByRequestedTime*0.02;
  $severeImpact->casesForVentilatorsByRequestedTime=$impact->infectionsByRequestedTime*0.02;

  $impact->dollarsInFlight=$impact->infectionsByRequestedTime*0.65*1.5*30;
  $severeImpact->dollarsInFlight=$impact->infectionsByRequestedTime*0.65*1.5*30;

  // echo "$impact->currentlyInfected <br>";
  // echo "$severeImpact->currentlyInfected <br>";
  // echo "$impact->severeCasesByRequestedTime <br>";
  // echo "$severeImpact->severeCasesByRequestedTime <br>";
  // echo "$impact->hospitalBedsByRequestedTime <br>";
  // echo "$impact->dollarsInFlight <br>";
  return $data;
  return $impact;
  return $severeImpact;
}
covid19ImpactEstimator($data);
?>