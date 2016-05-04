<?php

/**
 * Created by PhpStorm.
 * User: lolo
 * Date: 04.05.2016
 * Time: 01:12
 */
abstract class EnumType {
  private $val;

  public abstract function getFields();

  final function __construct( $str ) {
     $this->val = $str;
  }

  public static function __callStatic( $func, $args ) {
    return new static( $func );
  }

  public function value() {
    return $this->val;
  }

  public function __toString() {
    return $this->value();
  }
}