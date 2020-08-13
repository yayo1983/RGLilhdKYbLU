<?php


namespace App\Business;


abstract class  RequestAbstract implements iRequest
{
  private $request;

  public function __construct(iRequest $request)
  {
     $this->request = $request;
  }
}
