<?php

/**
 * Created by PhpStorm.
 * User: lolo
 * Date: 04.05.2016
 * Time: 00:14
 */
final class PointType extends EnumType implements Resolver {
  const
    LOVE = 'Love',
    FIFTEEN = 'Fifteen',
    THIRTY = 'Thirty',
    FORTY = 'Forty';


  public function getFields() {
    return array( self::LOVE, self::FIFTEEN, self::THIRTY, self::FORTY);
  }

  public function resolvePoints($pointType){

    if($this == $pointType){
      if ($this != self::FORTY) {
        return $this->value() . "-All";
      } else {
        return "Deuce";
      }
    }
    return $this->value() ."-".$pointType->value();
  }

}

