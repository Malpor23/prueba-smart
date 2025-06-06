<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class UnauthorizedException extends Exception
{
    protected int $statusCode;
    protected string $errorType;

    public function __construct(string $message = '', int $statusCode = 401, string $errorType = 'unauthenticated')
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
        $this->errorType = $errorType;
    }

    public static function notAuthenticated(): self
    {
        return new self(
            'No tienes una sesión activa. Por favor inicia sesión para continuar.',
            401,
            'unauthenticated'
        );
    }

    public static function notAuthorized(): self
    {
        return new self(
            'No tienes permisos suficientes para realizar esta acción. Se requieren privilegios de administrador.',
            403,
            'unauthorized'
        );
    }

    public static function invalidCredentials(): self
    {
        return new self(
            'Las credenciales proporcionadas son incorrectas. Verifica tu email y/o contraseña.',
            401,
            'invalid_credentials'
        );
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'error' => $this->errorType,
            'message' => $this->getMessage(),
            'status_code' => $this->statusCode
        ], $this->statusCode);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getErrorType(): string
    {
        return $this->errorType;
    }
}
