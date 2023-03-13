<?php

namespace Sophy\Validation;

use DavidePastore\Slim\Validation\Validation;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Validator extends Validation
{
    public function validate(array $validationRules, ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $translator = function ($message) {
            $messages = [
                'These rules must pass for {{name}}' => 'Estas validaciones deben ser aplicadas en el valor de {{name}}',
                '{{name}} must be a string' => '{{name}} debe ser un texto',
                '{{name}} must have a length between {{minValue}} and {{maxValue}}' => '{{name}} debe tener una longitud entre {{minValue}} y {{maxValue}}',
                '{{name}} must contain only letters (a-z) and digits (0-9)' => '{{name}} debe contener solo letras (a-z) y dígitos (0-9)',
            ];
            return $messages[$message];
        };

        $this->setValidators($validationRules);
        $this->setTranslator($translator);

        return $this->__invoke($request, $handler);
    }
}