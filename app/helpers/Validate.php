<?php

require_once 'app/validators/Validators.php';

class Validator
{
  private $validators;

  public function __construct()
  {
    $this->validators =  new Validators();
  }



  public function userSchema()
  {
    $userSchema = [
      "firstName" => [$this->validators->required()],
      "lastName" => [$this->validators->required()],
      "age" => [$this->validators->required()],
      "email" => [$this->validators->required(), $this->validators->validateEmail(), $this->validators->isEmailExist()],
      "password" => [$this->validators->required(),$this->validators->checkPassword()],
      "nationality" => [$this->validators->required()],
      "country" => [$this->validators->required()],
    ];

    return $this->toSchema($userSchema);
  }

  private function toSchema($schema)
  {
    $ret = [];

    foreach ($schema as $fieldName => $fields) {

      foreach ($fields as $field) {
        $ret[$fieldName][$field["validatorName"]] = $field;
      }
    }
    return $ret;
  }

  public function validate($schema, $body)
  {


    $fieldNames = array_keys($schema); // Kikérjük a fieldname-eket;

    $ret = [];

    foreach ($fieldNames as $fieldName) {
      $ret[$fieldName] = [];
    }


    //Átalakitás kész

    foreach ($fieldNames as $fieldName) {
      $validators = $schema[$fieldName];
      foreach ($validators as $validator) {
        $validatorFn = $validator["validatorFn"];
        $isFieldValid = $validatorFn($body[$fieldName]);

        if (!$isFieldValid) {
          $ret[$fieldName][] = [
            "validatorName" => $validator["validatorName"],
            "value" => $body[$fieldName] ?? null
          ];
        }
      }
    }
    return $ret;
  }


  public function getErrorMessages($schema, $errors)
  {
    $validatorNameToMessage  = [
      "required" => fn () => "A mező kitöltése kötelező!",
      "checkPassword" => fn () => "Jelszónak tartalmaznia kell Nagy, Kisbetűt, Számot és Speciális karaktert",
      "validateEmail" => fn () => "Email formátuma nem megfelelő!",
      "isEmailExist" => fn () => "Ezzel az e-mail cimmel már regisztráltak!"
    ];

    $ret = [];

    if (!empty($errors)) {
      foreach ($errors as $fieldName =>  $errorsForField) {
        foreach ($errorsForField as $err) {
          $toMessageFn = $validatorNameToMessage[$err["validatorName"]];
          $schemaForField = $schema[$fieldName];
          $ret[$fieldName][] = $toMessageFn($err["value"],  $schemaForField[$err["validatorName"]]["params"]);
        }
      }
    }
    return $ret;
  }
}
